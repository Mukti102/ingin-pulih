<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ReviewSections extends Component
{
    /**
     * Create a new component instance.
     */
    public $activeReviews;
    public function __construct($activeReviews = null)
    {
        $this->activeReviews = $activeReviews;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.review-sections');
    }
}
