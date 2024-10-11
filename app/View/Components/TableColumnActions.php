<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TableColumnActions extends Component
{
    public $id;
    public $route_edit;
    public $route_destroy;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id,$route_edit,$route_destroy)
    {
        $this->id = $id;
        $this->route_edit = $route_edit;
        $this->route_destroy = $route_destroy;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.table-column-actions');
    }
}
