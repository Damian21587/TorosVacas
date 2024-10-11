<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormTextfield extends Component
{
    public $id;
    public $required;
    public $modelo;
    public $label;
    public $locale;
    public $text;
    public $help;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $required, $label, $modelo = null, $text = null, $locale = null, $help = null)
    {
        $this->id = $id;
        $this->required = $required;
        $this->modelo = $modelo;
        $this->label = $label;
        $this->text = $text;
        $this->locale = $locale;
        $this->help = $help;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $value = null;
        if (isset($this->locale))
            $value = old($this->id, isset($this->modelo) ? $this->modelo->getTranslation($this->text, $this->locale) : '');
        else
            $value = old($this->id, isset($this->modelo) ? $this->modelo->{$this->id }: '');
        return view('components.form-textfield',compact('value'));
    }
}
