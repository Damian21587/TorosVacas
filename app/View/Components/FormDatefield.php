<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormDatefield extends Component
{
    public $id;
    public $required;
    public $modelo;
    public $label;
    public $min;
    public $max;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $required, $modelo = null ,$min = null,$max = null, $label)
    {
        $this->id = $id;
        $this->required = $required;
        $this->modelo = $modelo;
        $this->label = $label;
        $this->min = $min;
        $this->max = $max;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form-datefield');
    }
}
