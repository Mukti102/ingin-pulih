<?php

namespace App\Services;

use App\Models\SessionMeet;
use App\Models\SessionNote;
use App\Models\SessionRoom;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SessionMeetService
{

    public function list()
    {
        $sessions = SessionMeet::with('booking')->whereHas('booking', function ($query) {
            $query->whereHas('psycholog', function ($query) {
                $query->where('user_id', Auth::id());
            });
        });

        return $sessions->latest()->get();
    }

    public function store(array $data)
    {
        $session = DB::transaction(function () use ($data) {
            SessionMeet::create($data);
        });

        return $session;
    }


    public function find($id)
    {
        $id = decrypt($id);
        $session = SessionMeet::with('booking', 'room')->find($id);
        return $session;
    }

    public function storeRoom(array $data, $id)
    {
        DB::beginTransaction();
        try {
            $session = SessionMeet::findOrFail($id);

            if ($session->room) {
                $session->room->update([
                    'provider'     => $data['provider'],
                    'room_code'    => $data['room_code'],
                    'meeting_link' => $data['meeting_link'],
                ]);
                $session->status = 'active';
                $session->save();
            } else {
                $session->room()->create([
                    'provider'     => $data['provider'],
                    'room_code'    => $data['room_code'],
                    'meeting_link' => $data['meeting_link'],
                ]);
                $session->status = 'active';
                $session->save();
            }

            DB::commit();
            return $session;
        } catch (\Exception $e) {
            Log::info('error store room',['message' => $e->getMessage()]);
            Log::error('Error storing room:', ['message' => $e->getMessage(), 'session_id' => $id]);
            DB::rollBack();
            throw $e;
        }
    }

    public function storeNote(array $data, $id)
    {
        DB::beginTransaction();
        try {
            $session = SessionMeet::findOrFail($id);
            $authPsycholog = auth()->user()->psycholog;

            $documentFile = $data['document_path'] ?? null;

            $existingNote = $session->note;
            if ($existingNote) {
                $path = $existingNote->document_path;
                if ($documentFile) {
                    if ($path) {
                        Storage::disk('public')->delete($path);
                    }
                    $path = $documentFile->store('note', 'public');
                }

                $existingNote->update([
                    'psycholog_id' => $authPsycholog->id,
                    'notes'         => $data['notes'],
                    'document_path' => $path,
                ]);
                $session->status = 'completed';
                $session->save();
            } else {
                $path = null;
                if ($documentFile) {
                    $path = $documentFile->store('note', 'public');
                }

                $session->note()->create([
                    'psycholog_id' => $authPsycholog->id,
                    'notes'         => $data['notes'],
                    'document_path' => $path,
                ]);

                $session->status = 'completed';
                $session->save();
            }

            DB::commit();
            return $session;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
