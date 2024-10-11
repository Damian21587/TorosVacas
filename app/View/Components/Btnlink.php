<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Btnlink extends Component
{
    public $href;
    public $slot;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($href,$slot)
    {
        $this->href = $href;
        $this->slot = $slot;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.btnlink');
    }
}
