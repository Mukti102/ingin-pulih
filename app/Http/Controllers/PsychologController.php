<?php

namespace App\Http\Controllers;

use App\Http\Requests\PsychologRequest;
use App\Models\Psycholog;
use App\Models\Topic;
use App\Models\Type;
use App\Models\User;
use App\Models\Wilayah;
use App\Services\PsychologService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PsychologController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $psychologService;

    public function __construct(PsychologService $psychologService)
    {
        $this->psychologService = $psychologService;
    }

    public function register()
    {
        $wilayahs = Wilayah::all();
        $types = Type::all();
        $topics = Topic::all();
        return view('pages.client.auth.register-psychologist', compact('wilayahs', 'types', 'topics'));
    }

    public function index(Request $request)
    {
        // Mengambil data psikolog yang sudah difilter melalui service
        $psychologs = $this->psychologService->list($request);

        // Data untuk dropdown filter
        $wilayahs = Wilayah::all();
        $types = Type::all();

        return view('pages.dashboard.psychologs.index', compact('psychologs', 'wilayahs', 'types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $wilayahs = Wilayah::all();
        $types = Type::all();
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'psycholog');
        })->get();
        $topics = Topic::all();
        return view('pages.dashboard.psychologs.create', compact('wilayahs', 'types', 'users', 'topics'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PsychologRequest $request)
    {
        try {
            $this->psychologService->store($request->all());
            toast('Berhasil Di Buat dan dikirim', 'success');
            return redirect()->back();
        } catch (Exception $th) {
            Log::info('Gagal', ['message' => $th->getMessage()]);
            toast('Gagal Menambhakan Psycholog', 'error');
            return redirect()->back();
        }
    }

    public function verified($id)
    {
        try {
            $this->psychologService->verified($id);
            toast('Berhasil Menverfikasi', 'success');
            return redirect()->back();
        } catch (Exception $th) {
            toast('Gagal Memverifikasi', 'error');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $id = decrypt($id);
        $psycholog =  $this->psychologService->find($id);
        return view('pages.dashboard.psychologs.show', compact('psycholog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $id = decrypt($id);
        $psycholog = $this->psychologService->find($id);
        $wilayahs = Wilayah::all();
        $types = Type::all();
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'psycholog');
        })->get();
        $topics = Topic::all();
        return view('pages.dashboard.psychologs.edit', compact('psycholog', 'wilayahs', 'users', 'topics', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PsychologRequest $request, Psycholog $psycholog)
    {
        try {
            $this->psychologService->update($psycholog, $request->all());
            toast('Berhasil Memperbarui Psycholog', 'success');
            return redirect()->route('psychologs.index');
        } catch (Exception $th) {
            toast('Gagal Memperbarui Psycholog', 'error');
            return redirect()->route('psychologs.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Psycholog $psycholog)
    {
        try {
            $this->psychologService->delete($psycholog);
            toast('Berhasil Menghapus Psycholog');
            return redirect()->route('psychologs.index');
        } catch (Exception $th) {
            toast('Gagal Menghapus Psycholog', 'error');
            return redirect()->back();
        }
    }
}
