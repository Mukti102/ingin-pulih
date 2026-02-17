<?php

namespace App\Http\Controllers;

use App\Http\Requests\PsychologistWeeklyRequest;
use App\Models\PsychologistWeeklySchedule;
use App\Services\PsychologistWeeklyScheduleService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PsychologistWeeklyScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $psychologistWeeklyScheduleService;
    public function __construct(PsychologistWeeklyScheduleService $psychologistWeeklyScheduleService)
    {
        $this->psychologistWeeklyScheduleService = $psychologistWeeklyScheduleService;
    }

    public function index()
    {
        if (!auth()->user()->isPsycholog()) {
            abort(403);
        }

        $psycholog = auth()->user()->psycholog;

        $schedules = $this->psychologistWeeklyScheduleService
            ->listByPsycholog($psycholog->id);

        return view(
            'pages.dashboard.psycholog.weeklySchedule.index',
            compact('schedules')
        );
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
    public function store(PsychologistWeeklyRequest $request)
    {
        try {
            $psycholog = auth()->user()->psycholog;

            $this->psychologistWeeklyScheduleService->store([
                'psycholog_id' => $psycholog->id,
                ...$request->validated()
            ]);

            toast('Jadwal berhasil ditambahkan', 'success');

            return back()->with('success', 'Jadwal berhasil ditambahkan');
        } catch (Exception $th) {
            Log::info('gagal jadwa', ['message' => $th->getMessage()]);
            toast('Jadwal Gagal ditambahkan', 'error');
            return redirect()->back();
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(PsychologistWeeklySchedule $psychologistWeeklySchedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PsychologistWeeklySchedule $psychologistWeeklySchedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PsychologistWeeklyRequest $request, PsychologistWeeklySchedule $psychologistWeeklySchedule)
    {
        try {
            $psycholog = auth()->user()->psycholog;

            $this->psychologistWeeklyScheduleService->update($psychologistWeeklySchedule, [
                'psycholog_id' => $psycholog->id,
                ...$request->validated()
            ]);

            toast('Jadwal Berhasil Di perbarui', 'success');

            return back()->with('success', 'Jadwal berhasil diperbarui');
        } catch (Exception $th) {
            Log::info('gagal jadwa', ['message' => $th->getMessage()]);

            toast('Gagal Memperbarui', 'error');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {   
        $psychologistWeeklySchedule = PsychologistWeeklySchedule::find($id);
        try {
            $this->psychologistWeeklyScheduleService->delete($psychologistWeeklySchedule);
            toast('Jadwal Berhasil Di Hapus', 'success');
            return redirect()->back();
        } catch (Exception $th) {
            toast('Jadwal Gagal Di Hapus', 'error');
            return redirect()->back();
        }
    }
}
