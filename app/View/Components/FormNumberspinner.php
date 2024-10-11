<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormNumberspinner extends Component
{
    public $id;
    public $required;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id,$required)
    {
        $this->id = $id;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form-numberspinner');
    }
}
