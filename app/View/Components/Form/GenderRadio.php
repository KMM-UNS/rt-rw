<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class GenderRadio extends Component
{
    public $name;
    public $selected;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($selected, $name)
    {
        $this->selected = $selected;
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.gender-radio');
    }
}
