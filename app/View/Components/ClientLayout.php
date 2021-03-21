<?php

namespace App\View\Components;

use App\Models\Store;
use Illuminate\View\Component;

class ClientLayout extends Component
{
    public $store;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Store $store)
    {
        $this->store = $store;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('layouts.client.app');
    }
}
