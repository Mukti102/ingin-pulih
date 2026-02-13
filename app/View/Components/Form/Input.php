<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class Input extends Component
{
    public $name;
    public $label;
    public $type;
    public $value;
    public $required;

    public function __construct(
        $name,
        $label = null,
        $type = 'text',
        $value = null,
        $required = false
    ) {
        $this->name = $name;
        $this->label = $label;
        $this->type = $type;
        $this->value = $value;
        $this->required = $required;
    }

    public function render()
    {
        return view('components.form.input');
    }
}
