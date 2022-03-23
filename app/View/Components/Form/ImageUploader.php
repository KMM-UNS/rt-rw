<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;
use Illuminate\Support\Str;

class ImageUploader extends Component
{
    public $imageSrc;
    public $title;
    public $name;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($imageSrc = null, $name = null, $title)
    {
        $this->imageSrc = $imageSrc;
        $this->title = $title;
        $this->name = $name ?? Str::replace('-', '_', Str::slug($title));
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.image-uploader');
    }
}
