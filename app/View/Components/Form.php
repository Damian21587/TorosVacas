<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Form extends Component
{
    public $action;
    public $id;
    public $enctype;
    public $method;
    public $api;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($action, $enctype, $method, $id, $api = null)
    {
        $this->action = $action;
        $this->enctype = $action;
        $this->method = $method;
        $this->id = $id;
        $this->api = $api;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form');
    }
}
