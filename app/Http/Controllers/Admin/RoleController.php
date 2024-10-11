<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\Flash;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->view_index = 'admin.roles.index';
        $this->view_create = 'admin.roles.create';
        $this->view_edit = 'admin.roles.edit';
        $this->view_show = 'admin.roles.show';

        $this->route_index = 'admin.manager.roles.index';
        $this->route_create = 'admin.manager.roles.create';
        $this->route_edit = 'admin.manager.roles.edit';
        $this->route_show = 'admin.manager.roles.show';

        $this->middleware('hasPermission:roles.create')->only(['create', 'store']);
        $this->middleware('hasPermission:roles.destroy')->only(['destroy']);
        $this->middleware('hasPermission:roles.index')->only(['index']);
        $this->middleware('hasPermission:roles.edit')->only(['update', 'edit']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $count = count(Role::all());
        $roles = Role::latest()->paginate($count);
        return view($this->view_index, compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permisos = Permission::all();
        return view($this->view_create, compact('permisos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRoleRequest $request)
    {
        DB::beginTransaction();
        $input = $request->validated();
        $role = Role::create($input);
        if ($role) {
            $role->permisos()->attach($request->permisos);
            DB::commit();
            return $this->redirectSuccess(__('general.add-content', ['contenido' => 'Rol']));
        }
        DB::rollback();
        return $this->redirectFailed(__('general.error-content', ['contenido' => 'Rol']));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Role $role)
    {
        if (empty($role))
            return $this->redirectFailed(__('general.error-content-no-found', ['contenido' => 'Rol']));

        $permisos = Permission::all();
        $role->permisos = $role->permisos()->get()->modelKeys();
        return view($this->view_edit, compact('role', 'permisos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoleRequest $request, $id)
    {

        DB::beginTransaction();
        $role = Role::find($id);
        $input = $request->validated();
        if ($role->update($input)) {
            $role->permisos()->detach();
            $role->permisos()->attach($request->permisos);
            DB::commit();
            return $this->redirectSuccess(__('general.edit-content', ['contenido' => 'Rol']));
        }
        DB::rollback();
        return $this->redirectFailed(__('general.error-content', ['contenido' => 'Rol']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        /** @var User $user */
        $role = Role::find($id);
        if (empty($role))
            return $this->redirectFailed(__('general.error-content-no-found', ['contenido' => 'Rol']));

        DB::beginTransaction();
        if ($role) {
            Role::destroy($id);
            DB::commit();
            return $this->redirectSuccess(__('general.delete-content', ['contenido' => 'Rol']));
        }
        DB::rollback();
        return $this->redirectFailed(__('general.error-content', ['contenido' => 'Rol']));
    }
}
