<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardPsikolog extends Component
{
    /**
     * Create a new component instance.
     */
    public $psikolog;
    public function __construct($psikolog)
    {
        $this->psikolog = $psikolog;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card-psikolog');
    }
}
