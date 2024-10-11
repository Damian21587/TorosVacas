<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ContentIndex extends Component
{
    public $title;
    public $columns_header;
    public $columns_body;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $columns_header = null, $columns_body = null)
    {
        $this->title = $title;
        $this->columns_header = $columns_header;
        $this->columns_body = $columns_body;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.content-index');
    }
}
