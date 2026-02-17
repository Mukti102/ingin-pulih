<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::latest()->get();
        return view('pages.dashboard.services.index', compact('services'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:5',
            'description' => 'nullable|string',
            'duration_minutes' => 'required|integer|min:0'
        ]);

        Service::create($validated);

        toast('Berhasil Menambahkan Layanan', 'success');
        return redirect()->back();
    }

    /**
     * UPDATE
     */
    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'name' => 'required|min:5',
            'description' => 'nullable|string',
            'duration_minutes' => 'required|integer|min:0'
        ]);

        $service->update($validated);

        toast('Berhasil Mengupdate Layanan', 'success');
        return redirect()->back();
    }

    /**
     * DELETE
     */
    public function destroy(Service $service)
    {
        $service->delete();

        toast('Berhasil Menghapus Layanan', 'success');
        return redirect()->back();
    }
}
