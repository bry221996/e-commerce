<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class MultiSelect extends Component
{
    protected $data;
    protected $name;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $data)
    {
        $this->name = $name;
        $this->data = $data;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.form.multi-select', [
            'data' => $this->data,
            'name' => $this->name,
        ]);
    }
}
