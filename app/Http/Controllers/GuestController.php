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
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $id = decrypt($id);
        $psychologist = Psycholog::with(['user', 'wilayah', 'jenisPsikolog', 'topics', 'services', 'weeklySchedules', 'booking', 'reviews.booking.user'])
            ->find($id);

        // Ambil hanya review yang sudah dipublish
        $activeReviews = $psychologist->reviews()->where('published', true)->latest()->get();

        // Hitung rata-rata rating
        $averageRating = $activeReviews->avg('rating') ?? 0;
        $totalReviews = $activeReviews->count();

        return view('pages.guest.listPsychologs.show', compact('psychologist', 'activeReviews', 'averageRating', 'totalReviews'));
    }
}
