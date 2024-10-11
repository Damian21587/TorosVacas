<?php

namespace App\Auth;

use App\Events\UpdatedSite;
use App\Models\SiteDescriptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait Info
{
    public function index(Request $request){
        $tipo = property_exists($this, 'tipo') ? $this->tipo : null;
        if($tipo) {
            $infos = SiteDescriptions::where('tipo', $tipo)->get();
            return view('admin.institucion.index', compact('infos','tipo'));
        }
        else return abort(404);
    }

    public function edit(Request $request,$id)
    {
        //
        $info=SiteDescriptions::findOrfail($id);
        $tipo = property_exists($this, 'tipo') ? $this->tipo : null;
        if($tipo == $info->tipo) {
            return view('admin.institucion.edit', ['info' => $info]);
        }
        else return abort(404);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $info = SiteDescriptions::findOrfail($id);
        $validated = $request->all();
        $info->update($validated);
        //Actualizar
        if($request->has('imagen') && $request->hasFile('imagen')){
                $old_file = $info->imagen;
                $info->imagen = $request->imagen->store('info', 'public');
                $info->save();
                if($old_file)
                    Storage::delete($old_file);
            }
        else{
            $info->save();
        }
        $redirect = property_exists($this, 'redirectTo') ? $this->redirectTo : '/admin';
        $key = 'bpa.'.$info->tipo;
        $tran =trans($key);
        return redirect()->route($redirect)->with('success', __('bpa.edit-content',['contenido'=>$tran]));
    }
}
