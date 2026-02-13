<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class CheckboxGroup extends Component
{
    public $name;
    public $label;
    public $options;
    public $selected;

    public function __construct($name, $label = null, $options = [], $selected = [])
    {
        $this->name = $name;
        $this->label = $label;
        $this->options = $options;
        $this->selected = $selected;
    }

    public function render()
    {
        return view('components.form.checkbox-group');
    }
}
