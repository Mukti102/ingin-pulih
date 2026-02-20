<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
  public function index()
    {
        $settings = Setting::all()->pluck('value', 'key')->toArray();
        return view('pages.dashboard.setting', compact('settings'));
    }

    public function update(Request $request)
    {
        // Ambil semua data kecuali token dan method
        $settings = $request->except(['_token', '_method']);

        foreach ($settings as $key => $value) {
            // Jika value adalah file (misal logo), handle uploadnya
            if ($request->hasFile($key)) {
                $value = $request->file($key)->store('settings', 'public');
            }

            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        toast('Berhasil memperbarui pengaturan', 'success');

        return back()->with('success', 'Pengaturan berhasil diperbarui!');
    }
}
