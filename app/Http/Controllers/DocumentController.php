<?php

namespace App\Http\Controllers;

use App\Mail\VerifyDocumentMail;
use App\Models\Psycholog;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class DocumentController extends Controller
{
    public function show(Psycholog $psycholog)
    {
        $user = auth()->user();

        if (!$user->hasRole('admin') && $user->id !== $psycholog->user_id) {
            abort(403, "Anda Tidak Memiliki Akses");
        }

        if (!Storage::disk('local')->exists($psycholog->document->file_path)) {
            abort(404, 'File tidak ditemukan.');
        }

        return Storage::disk('local')->response($psycholog->document->file_path);
    }

    public function verified(Request $request, $id)
    {
        try {
            $id = decrypt($id);
            $psycholog = Psycholog::with('user','document')->find($id);

            $document = $psycholog->document;

            $isVerified = $request->verification_status;

            $document->is_verified = $isVerified == 'complete' ? true : false;
            
            if ($document->is_verified) {
                $document->verified_by = Auth::user()->id;
            }

            if ($psycholog->is_verified && $document->is_verified) {
                $psycholog->verification_status = 'complete';
                $psycholog->save();
            }

            $document->note = $request->note;
            $document->save();

            // send email
            Mail::to($psycholog->user->email)->queue(new VerifyDocumentMail($psycholog,$document->is_verified ? 'complete' : 'failed'));
            toast('Berhasil Menverifikasi Document', 'success');
            return redirect()->back();
        } catch (Exception $th) {
            toast('Gagal Memverifikasi Document', 'error');
            return redirect()->back();
        }
    }
}
