<?php

namespace App\Services;

use App\Models\Psycholog;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PsychologService
{
    /**
     * List all
     */
    public function list(Request $request)
    {
        $query = Psycholog::with([
            'user',
            'wilayah',
            'jenisPsikolog',
            'topics'
        ]);

        if ($request->filled('wilayah_id')) {
            $query->where('wilayah_id', $request->wilayah_id);
        }

        if ($request->filled('jenis_id')) {
            $query->where('jenis_psikolog', $request->jenis_id);
        }

        if ($request->filled('status')) {
            $query->where('verification_status', $request->status);
        }

        return $query->latest()->get();
    }

    /**
     * Find by ID
     */
    public function find($id)
    {
        return Psycholog::with([
            'user',
            'wilayah',
            'jenisPsikolog',
            'topics',
            'document'
        ])->findOrFail($id);
    }

    public function verified(string $encryptedId)
    {
        $id = decrypt($encryptedId);

        $psycholog = Psycholog::with('document')->findOrFail($id);

        // toggle status
        $psycholog->is_verified = !$psycholog->is_verified;

        $isDocumentVerified = optional($psycholog->document)->is_verified ?? false;

        if ($psycholog->is_verified && $isDocumentVerified) {
            $psycholog->verification_status = 'complete';
        } else {
            $psycholog->verification_status = 'pending';
        }

        $psycholog->save();

        return $psycholog;
    }


    /**
     * Store
     */
    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {

            $topics = $data['topics'] ?? [];
            $documentFile = $data['document_legal'] ?? null;

            unset($data['topics'], $data['document_legal']);

            $data['verification_status'] = $data['verification_status'] ?? 'pending';
            $psycholog = Psycholog::create($data);

            if ($documentFile instanceof \Illuminate\Http\UploadedFile) {
                $path = $documentFile->store('private_docs', 'local');

                $psycholog->document()->create([
                    'file_path' => $path
                ]);
            }

            // 4. Sync Topics
            if (!empty($topics)) {
                $psycholog->topics()->sync($topics);
            }

            return $psycholog;
        });
    }

    /**
     * Update
     */
    public function update(Psycholog $psycholog, array $data)
    {
        return DB::transaction(function () use ($psycholog, $data) {
            $topics = $data['topics'] ?? [];
            $documentFile = $data['document_legal'] ?? null;

            unset($data['topics'], $data['document_legal']);

            $psycholog->update($data);

            if ($documentFile instanceof \Illuminate\Http\UploadedFile) {
                $oldDocument = $psycholog->document;

                if ($oldDocument && $oldDocument->file_path) {
                    Storage::disk('local')->delete($oldDocument->file_path);
                }

                $newPath = $documentFile->store('private_docs', 'local');

                $psycholog->document()->updateOrCreate(
                    ['psycholog_id' => $psycholog->id],
                    ['file_path' => $newPath]
                );
            }

            $psycholog->topics()->sync($topics);

            return $psycholog;
        });
    }

    public function delete(Psycholog $psycholog)
    {
        return DB::transaction(function () use ($psycholog) {
            $document = $psycholog->document;

            if ($document && $document->file_path) {
                if (Storage::disk('local')->exists($document->file_path)) {
                    Storage::disk('local')->delete($document->file_path);
                }
            }

            $psycholog->topics()->detach();

            if ($document) {
                $document->delete();
            }

            return $psycholog->delete();
        });
    }
}
