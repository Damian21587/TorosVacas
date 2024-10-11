<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormEnum extends Component
{
    public $id;
    public $required;
    public $datos;
    public $modelo;
    public $label;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $required, $datos, $label, $modelo = null)
    {
        $this->id = $id;
        $this->required = $required;
        $this->datos = $datos;
        $this->modelo = $modelo;
        $this->label = $label;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form-enum');
    }
}
