<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Services\ArticleService;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    public function index()
    {
        try {
            $articles = $this->articleService->list();
            return view('pages.dashboard.articles.index', compact('articles'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to load articles: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.dashboard.articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $article = $this->articleService->store($request->all());
            toast()->success('Article created successfully.');
            return redirect()->route('articles.index');
        } catch (\Exception $e) {
            toast()->error('Failed to create article: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return view('pages.dashboard.articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        return view('pages.dashboard.articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        try {
            $article = $this->articleService->update($request->all(), $article);
            toast()->success('Article updated successfully.');
            return redirect()->route('articles.index')->with('success', 'Article updated successfully.');
        } catch (\Exception $e) {
            toast()->error('Failed to update article: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update article: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        try {
            $this->articleService->delete($article);
            toast()->success('Article deleted successfully.');
            return redirect()->route('articles.index')->with('success', 'Article deleted successfully.');
        } catch (\Exception $e) {
            toast()->error('Failed to delete article: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete article: ' . $e->getMessage());
        }
    }
}
