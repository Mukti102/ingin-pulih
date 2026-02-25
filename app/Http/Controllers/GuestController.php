<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Psycholog;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function home()
    {
        return view('pages.guest.home');
    }

    public function articles()
    {
        $articles = Article::latest()->get();
        return view('pages.guest.articles.index', compact('articles'));
    }

    public function showArticle($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        $relatedArticles = Article::where('id', '!=', $article->id)
            ->where(function ($query) use ($article) {
                foreach ($article->tags as $tag) {
                    $query->orWhere('tags', 'like', '%' . $tag . '%');
                }
            })
            ->limit(3)
            ->get();
        return view('pages.guest.articles.show', compact('article','relatedArticles'));
    }

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
        $psychologist = Psycholog::with(['user', 'wilayah', 'jenisPsikolog', 'topics', 'services', 'weeklySchedules', 'booking', 'reviews.booking.user','educations'])
            ->find($id);

        $activeReviews = $psychologist->reviews()->where('published', true)->latest()->get();

        $averageRating = $activeReviews->avg('rating') ?? 0;
        $totalReviews = $activeReviews->count();

        return view('pages.guest.listPsychologs.show', compact('psychologist', 'activeReviews', 'averageRating', 'totalReviews'));
    }
}
