<?php

namespace App\Http\Controllers;

use App\Models\Psycholog;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function listPsychologs()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        return view('pages.guest.listPsychologs.index');
    }

    public function detailPsikolog($id)
    {
        $id = decrypt($id);
        $psychologist = Psycholog::with('user', 'wilayah', 'jenisPsikolog', 'topics', 'services', 'weeklySchedules', 'booking')->find($id);
        return view('pages.guest.listPsychologs.show', compact('psychologist'));
    }
}
