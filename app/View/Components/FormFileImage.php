<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormFileImage extends Component
{
    public $id;
    public $required;
    public $modelo;
    public $label;
    public $showList;
    public $help;
    public $help2;
    public $help3;
    public $accept;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $required,  $label,$modelo = null, $showList = null, $help = null, $help2 = null,$help3 = null, $accept = null)
    {
        $this->id = $id;
        $this->required = $required;
        $this->modelo = $modelo;
        $this->help = $help;
        $this->help2 = $help2;
        $this->help3 = $help3;
        $this->label = $label;
        $this->showList = $showList;
        $this->accept = $accept;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form-file-image');
    }
}
