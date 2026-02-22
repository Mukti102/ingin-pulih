<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteRequest;
use App\Http\Requests\RoomRequest;
use App\Models\SessionMeet;
use App\Services\BookingService;
use App\Services\SessionMeetService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class SessionMeetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $sessionMeetService;
    protected $bookingService;

    public function __construct(SessionMeetService $sessionMeetService, BookingService $bookingService)
    {
        $this->sessionMeetService = $sessionMeetService;
        $this->bookingService = $bookingService;
    }

    public function index()
    {
        $authPsycholog = auth()->user()->psycholog;
        if (!$authPsycholog) {
            toast()->error('Anda tidak memiliki akses ke halaman ini.');
            return redirect()->route('dashboard');
        }
        $bookings = $this->bookingService->list($authPsycholog->id);
        $sessions = $this->sessionMeetService->list();
        return view('pages.dashboard.psycholog.sessions.index', compact('sessions', 'bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $this->sessionMeetService->store($request->all());
            toast('Berhasil Menambahkan Sesi', 'success');
            return redirect()->route('sessions.index');
        } catch (Exception $th) {
            Log::info('error session', ['message' => $th->getMessage()]);
            toast('Gagal menambahkan sesi', 'error');
            return redirect()->back();
        }
    }

    public function storeNote(NoteRequest $request, $id)
    {
        try {
            $this->sessionMeetService->storeNote($request->all(), $id);
            toast('Berhasil Menambahkan catatan', 'success');
            return redirect()->back();
        } catch (Exception $e) {
            toast('Gagal Menambahkan Catatan', 'error');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $session = $this->sessionMeetService->find($id);
        return view('pages.dashboard.psycholog.sessions.show', compact('session'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SessionMeet $sessionMeet)
    {
        //
    }

    public function createRoom(RoomRequest  $request, $id)
    {
        try {
            $this->sessionMeetService->storeRoom($request->all(), $id);
            Alert('Success', 'Berhasil Membuat Room', 'success');
            return redirect()->back();
        } catch (Exception $th) {
            Alert('Success', 'Gagal Membuat Room', 'error');
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SessionMeet $sessionMeet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $sessionMeet = SessionMeet::findOrFail($id);
        try {
            $sessionMeet->delete();
            toast('Berhasil Menghapus Sesi', 'success');
            return redirect()->route('sessions.index');
        } catch (Exception $th) {
            toast('Gagal Menghapus Sesi', 'error');
            return redirect()->route('sessions.index');
        }
    }
}
