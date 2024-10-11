<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormGaleriaImagen extends Component
{
    public $id;
    public $required;
    public $label;
    public $galeryId;
    public $modelo;
    public $galeriaImagenes;
    public $rutaEliminarImagen;
    public $dimensions;
    public $countImages;
    public $limites;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $required, $label, $galeryId, $modelo = null, $galeriaImagenes = null, $rutaEliminarImagen = '', $dimensions = '',$limites = '', $countImages)
    {
        $this->id = $id;
        $this->required = $required;
        $this->label = $label;
        $this->galeryId = $galeryId;
        $this->modelo = $modelo;
        $this->galeriaImagenes = $galeriaImagenes;
        $this->rutaEliminarImagen = $rutaEliminarImagen;
        $this->dimensions = $dimensions;
        $this->countImages = $countImages;
        $this->limites = $limites;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        /* $imagenes = null;
         if (isset($this->modelo)) {
             $old_files[] = null;
             $query = $this->modelo->{$this->id};
             foreach ($this->modelo->{$this->id} as $item)
                 $old_files[] = $item;
             foreach ($old_files as $old_file) {
                 $query->where('url', $old_file);
             }
             dd($old_files);
             $imagenes = $this->modelo->{$this->id} !== null ? $this->modelo->{$this->id} : null;
         }*/


        return view('components.form-galeria-imagen');
    }
}
