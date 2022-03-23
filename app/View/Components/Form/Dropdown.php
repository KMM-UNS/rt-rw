<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class Dropdown extends Component
{
    public $name;
    public $options;
    public $selected;
    public $placeholder;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $options, $selected = '', $placeholder = null)
    {
        $this->name = $name;
        $this->options = $options;
        $this->selected = $selected;
        $this->placeholder = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.dropdown');
    }
}
