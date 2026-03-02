<?php

namespace App\Http\Controllers;

use App\Models\PsichologService;
use App\Models\Psycholog;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Services\PsychologServiceService;
use Exception;
use Illuminate\Validation\Rule;

class PsichologServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $psychologService;

    public function __construct(PsychologServiceService $psychologService)
    {
        $this->psychologService = $psychologService;
    }


    public function index()
    {
        $allServices = Service::all();
        $pyschologServices = $this->psychologService->list();
        return view('pages.dashboard.psycholog.psychologService.index', compact('pyschologServices', 'allServices'));
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

            $authPsycholog = Psycholog::where('user_id', auth()->user()->id)->first();
            $validated = $request->validate([
                'service_id' => [
                    'required',
                    'exists:services,id',
                    Rule::unique('psicholog_services')
                        ->where(
                            fn($query) =>
                            $query->where('psycholog_id', $authPsycholog)
                        )
                ],
                'price' => 'required|numeric|min:0',
            ]);

            $validated['psycholog_id'] = $authPsycholog->id;
            $validated['is_active'] = true;

            $this->psychologService->store($validated);

            toast('Berhasil menambahkan Layanan', 'success');

            return redirect()->back()->with('success', 'Layanan berhasil ditambahkan.');
        } catch (Exception $e) {
            toast('Gagal Menambahkan Layanan ' . $e->getMessage(), 'error');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PsichologService $psichologService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PsichologService $psichologService)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $psichologService = PsichologService::find($id);
        $authPsycholog = Psycholog::where('user_id', auth()->user()->id)->first();
        if ($psichologService->psycholog_id !== $authPsycholog->id) {
            abort(403);
        }


        $validated = $request->validate([
            'service_id' => [
                'required',
                'exists:services,id',
                Rule::unique('psicholog_services')
                    ->where(
                        fn($query) =>
                        $query->where('psycholog_id', $authPsycholog)
                    )
                    ->ignore($psichologService->id)
            ],
            'price' => 'required|numeric|min:0',
            'is_active' => 'required|boolean',
            'type' => 'required',
        ]);

        $this->psychologService->update($psichologService, $validated);

        toast('Berhasil Memperbarui Layanan', 'success');

        return redirect()->back()->with('success', 'Layanan berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $psichologService = PsichologService::find($id);
        try {
            $this->psychologService->delete($psichologService);
            toast('Berhasil Menghapus Layanan', 'success');
            return redirect()->back();
        } catch (Exception $th) {
            toast('Gagal Menghapu Layanan', 'error');
            return redirect()->back();
        }
    }
}
