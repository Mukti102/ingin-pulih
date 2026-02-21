<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Models\Review;
use App\Services\ReviewService;
use Illuminate\Container\Attributes\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log as FacadesLog;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $reviewService;

    public function __construct(ReviewService $reviewService)
    {
        $this->reviewService = $reviewService;
    }


    public function index()
    {
        $reviews = $this->reviewService->list();
        return view('pages.dashboard.psycholog.reviews.index', compact('reviews'));
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
    public function store(ReviewRequest $request)
    {           
        try {
            $review = $this->reviewService->store($request->all());
            toast('Berhasil Menambah Ulasan', 'success');
            return redirect()->back()->with('success', 'Review submitted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to submit review: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    public function togglePublish($id)
    {   
        try {
            $this->reviewService->togglePublished($id);
            toast('Berhasil Mempublish Ulasan', 'success');
            return redirect()->back()->with('success', 'Review status updated successfully.');
        } catch (\Exception $e) {
            toast('Gagal Mengubah Status Ulasan', 'error');
            return redirect()->back()->with('error', 'Failed to update review status: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        try {
            $this->reviewService->delete($review);
            toast('Berhasil Menghapus Ulasan', 'success');
            return redirect()->back()->with('success', 'Review deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete review: ' . $e->getMessage());
        }
    }
}
