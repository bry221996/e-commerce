<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class FileUploader extends Component
{
    protected $name;

    protected $accepts;

    protected $class;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $accepts, $class = '')
    {
        $this->name = $name;
        
        $this->accepts = $accepts;

        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.form.file-uploader', [
            'name' => $this->name, 
            'accepts' => $this->accepts, 
            'class' => $this->class
        ]);
    }
}
