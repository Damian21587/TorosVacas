<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormTextemail extends Component
{
    public $id;
    public $required;
    public $modelo;
    public $label;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id,$required,$label,$modelo = null)
    {
        $this->id = $id;
        $this->required = $required;
        $this->label = $label;
        $this->modelo = $modelo;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form-textemail');
    }
}
