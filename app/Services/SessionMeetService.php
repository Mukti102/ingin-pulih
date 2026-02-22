<?php

namespace App\Services;

use App\Mail\BookingConfirmedToClient;
use App\Mail\RoomAlreadyCreated;
use App\Models\SessionMeet;
use App\Models\SessionNote;
use App\Models\SessionRoom;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class SessionMeetService
{
    public $paymentService;
    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

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
        try {
            $session = DB::transaction(function () use ($data) {
                // TAMBAHKAN 'return' di depan create
                return SessionMeet::create($data);
            });

            // Pastikan relasi 'booking' dan 'user' sudah di-load agar pengiriman email lancar
            $session->load(['booking.user']);

            Mail::to($session->booking->user->email)->queue(new BookingConfirmedToClient($session->booking));

            return $session;
        } catch (\Exception $e) {
            Log::error('Error creating session meet:', ['message' => $e->getMessage(), 'data' => $data]);
            throw $e;
        }
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
            $session = SessionMeet::with('booking.user')->findOrFail($id);

            if ($session->room) {
                $session->room->update([
                    'provider'     => $data['provider'],
                    'room_code'    => $data['room_code'],
                    'meeting_link' => $data['meeting_link'],
                ]);
                $session->status = 'active';
                $session->save();

                Mail::to($session->booking->user->email)->queue(new RoomAlreadyCreated($session));
            } else {
                $session->room()->create([
                    'provider'     => $data['provider'],
                    'room_code'    => $data['room_code'],
                    'meeting_link' => $data['meeting_link'],
                ]);
                $session->status = 'active';
                $session->save();
                Mail::to($session->booking->user->email)->queue(new RoomAlreadyCreated($session));
            }

            DB::commit();
            return $session;
        } catch (\Exception $e) {
            Log::info('error store room', ['message' => $e->getMessage()]);
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
                $session->booking()->update(['status' => 'complete']);
                $session->save();

                $this->paymentService->saveSaldoPsycholog($session->booking->psycholog_id, $session->booking->earning);
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
                $session->booking()->update(['status' => 'complete']);
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
