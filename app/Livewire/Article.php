<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Article as ArticleModel;
use Livewire\WithPagination;

class Article extends Component
{
    use WithPagination;

    public $search = '';

    // Reset halaman ke 1 setiap kali search berubah
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $articles = ArticleModel::where('title', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(9);

        // Ambil 1 artikel terbaru untuk Jumbo Card
        $featured = ArticleModel::latest()->first();

        return view('livewire.article', [
            'all_articles' => $articles,
            'featured' => $featured
        ]);
    }
}