<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class ThumbnailImage extends Component
{
    protected $name;

    protected $class;

    public function __construct($name, $class)
    {
        $this->name = $name;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.form.thumbnail-image', ['name' => $this->name, 'class' => $this->class]);
    }
}
