<?php

namespace App\Services;

use App\Models\Article;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleService
{
    public function list()
    {
        return Article::latest()->paginate(10);
    }

    public function store(array $data)
    {
        DB::beginTransaction();
        try {
            $data['slug'] = Str::slug($data['title']) . '-' . uniqid();
            $data['thumbnail'] = $data['thumbnail']->store('articles', 'public');
            $article = Article::create($data);
            DB::commit();
            return $article;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function find($slug)
    {
        return Article::where('slug', $slug)->firstOrFail();
    }

    public function update(array $data, Article $article)
    {
        DB::beginTransaction();
        try {
            if (isset($data['title']) && $data['title'] !== $article->title) {
                $data['slug'] = Str::slug($data['title']) . '-' . uniqid();
            }
            if (isset($data['thumbnail'])) {
                // delete old thumbnail
                if ($article->thumbnail) {
                    Storage::disk('public')->delete($article->thumbnail);
                }

                $data['thumbnail'] = $data['thumbnail']->store('articles', 'public');
            }

            $article->update($data);
            DB::commit();
            return $article;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function delete(Article $article)
    {
        if ($article->thumbnail) {
            Storage::disk('public')->delete($article->thumbnail);
        }
        return $article->delete();
    }
}
