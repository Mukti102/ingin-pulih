<?php

namespace App\Http\Controllers;

use App\Models\Wilayah;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WilayahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wilayah = Wilayah::all();
        return view('pages.dashboard.wilayah.index', compact('wilayah'));
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
        $validated = $request->validate([
            'name' => 'required|min:5',
            'description' => 'nullable',
        ]);

        try {
            Wilayah::create($validated);
            toast('Berhasil Menambahkan Wilayah', 'success');
            return redirect()->route('wilayah-praktik.index');
        } catch (Exception $e) {
            Log::info('wilayah', ['message' => $e->getMessage()]);
            toast('Gagal Menambahkan Wilayah', 'error');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Wilayah $wilayah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Wilayah $wilayah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|min:5',
            'description' => 'nullable',
        ]);
        $wilayah = Wilayah::find($id);
        try {
            $wilayah->update($validated);
            toast('Berhasil Mengupdate Wilayah', 'success');
            return redirect()->back();
        } catch (Exception $e) {
            toast('Gagal Mengupdate Wilayah', 'error');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {   
        $wilayah = Wilayah::find($id);
        try {
            $wilayah->delete();
            toast('Berhasil Menghapus Wilayah', 'success');
            return redirect()->back();
        } catch (Exception $e) {
            toast('Gagal Menghapus Wilayah', 'error');
            return redirect()->back();
        }
    }
}
