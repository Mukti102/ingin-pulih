<?php

namespace App\Services;

use App\Models\Review;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ReviewService
{
    public function list()
    {
        return Review::with(['booking', 'psycholog', 'user'])->get();
    }

    public function store(array $data)
    {
        try {
            return DB::transaction(function () use ($data) {
                $data['rating'] = (int) $data['rating'];
                $data['user_id'] = auth()->id();
                $review = Review::create($data);

                return $review;
            });
        } catch (Exception $e) {
            Log::info('error review', ['message' => $e->getMessage()]);
        }
    }

    public function update(Review $review, array $data)
    {
        return DB::transaction(function () use ($review, $data) {
            $data['rating'] = (int) $data['rating'];
            $review->update($data);

            return $review->fresh();
        });
    }

    public function delete(Review $review)
    {
        return DB::transaction(function () use ($review) {
            return $review->delete();
        });
    }


    public function togglePublished($id)
    {
        $review = Review::findOrFail($id);
        return DB::transaction(function () use ($review) {
            $review->update(['published' => !$review->published]);
            return $review->save();
        });
    }
}
