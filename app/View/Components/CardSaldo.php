<?php

namespace App\View\Components;

use App\Services\PaymentService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardSaldo extends Component
{
    /**
     * Create a new component instance.
     */
    public $psycholog;
    public $saldo;
    public $paymentService;
    public function __construct($psycholog, PaymentService $paymentService)
    {
        $this->psycholog = $psycholog;
        $this->paymentService = $paymentService;
        $this->saldo = $this->paymentService->getSaldoPsycholog($psycholog->id);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card-saldo');
    }
}
