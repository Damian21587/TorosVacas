<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Images;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Laracasts\Flash\Flash;
use Response;
use Hash;
use App\Models\User;

class UserController extends Controller
{

    public function __construct()
    {
        $this->view_index = 'admin.users.index';
        $this->view_create = 'admin.users.create';
        $this->view_edit = 'admin.users.edit';
        $this->view_show = 'admin.users.show';
        $this->view_password = 'admin.users.password';

        $this->route_index = 'admin.manager.usuarios.index';
        $this->route_create = 'admin.manager.usuarios.create';
        $this->route_edit = 'admin.manager.usuarios.edit';
        $this->route_show = 'admin.manager.usuarios.show';

        $this->middleware('hasPermission:users.create')->only(['create', 'store']);
        $this->middleware('hasPermission:users.destroy')->only(['destroy']);
        $this->middleware('hasPermission:users.index')->only(['index']);
        $this->middleware('hasPermission:users.edit')->only(['update', 'editPassword', 'updatePassword', 'edit']);
    }

    /**
     * Display a listing of the User.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /** @var User $users */
        $count = count(User::all());
        $users = User::latest()->paginate($count);

        return view($this->view_index)
            ->with('users', $users);
    }

    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create()
    {
        $roles = Role::all();
        return view($this->view_create, compact('roles'));
    }

    /**
     * Store a newly created User in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        DB::beginTransaction();
        $input = $request->validated();
        $input['password'] = bcrypt($request->password);
        $image = new Images();
        if ($request->hasFile('image')) {
            $url = $request->image->store('users', 'public');
            $image->url = $url;
        }
        /** @var User $user */
        if ($user = User::create($input)) {
            $user->image()->save($image ?: '');
            DB::commit();
            return $this->redirectSuccess(__('general.add-content', ['contenido' => 'Usuario']));
        }
        DB::rollback();
        return $this->redirectFailed(__('general.error-content', ['contenido' => 'Usuario']));
    }

    /**
     * Display the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var User $user */
        /*$user = User::find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        return view('admin.users.show')->with('user', $user);*/
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var User $user */
        $user = User::find($id);
        $roles = Role::all();
        if (empty($user))
            return $this->redirectFailed(__('general.error-content-no-found', ['contenido' => 'Usuario']));

        return view('admin.users.edit', compact('roles', 'user'));
    }

    public function editPassword(Request $request, User $user)
    {
        return view($this->view_password, compact('user'));
    }

    public function updatePassword(Request $request, User $user)
    {
        $input['password'] = bcrypt($request->password);
        $rules = [
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',

        ];
        $attributes = [
            'password' => 'contraseña',
            'password_confirmation' => 'confirmar contraseña',
        ];
        $messages = [
            'required' => 'El campo :attribute es obligatorio.',
            'confirmed' => 'La confirmación del campo :attribute no coincide.',
        ];
        $this->validate($request, $rules, $attributes, $messages);
        $user->update($input);
        return $this->redirectSuccess(__('general.edit-content', ['contenido' => 'Contraseña']));
    }

    /**
     * Update the specified User in storage.
     *
     * @param int $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        /** @var User $user */
        DB::beginTransaction();
        $user = User::find($id);
        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $old_file = $user->image ? $user->image->url : null;
            $url = $request->image->store('users', 'public');
            if ($old_file) {
                Storage::disk('public')->delete($old_file);
                $user->image()->update(['url' => $url]);
            } else {
                $image = new Images();
                $image->url = $url;
                $user->image()->save($image ?: '');
            }
        }

        if (empty($user)) {
            DB::commit();
            return $this->redirectFailed(__('general.error-content-no-found', ['contenido' => 'Usuario']));
        }
        if ($user->update($validated)) {
            DB::commit();
            return $this->redirectSuccess(__('general.edit-content', ['contenido' => 'Usuario']));
        }
        DB::rollback();
        return $this->redirectFailed(__('general.error-content', ['contenido' => 'Usuario']));
    }

    /**
     * Remove the specified User from storage.
     *
     * @param int $id
     *
     * @return Response
     * @throws \Exception
     *
     */
    public function destroy($id)
    {

        /** @var User $user */
        DB::beginTransaction();
        $user = User::find($id);
        if (empty($user))
            return $this->redirectFailed(__('general.error-content-no-found', ['contenido' => 'Usuario']));

        if ($user) {
            if ($user->image != null) {
                Storage::disk('public')->delete($user->image->url);
                $user->image->delete();
            }
            User::destroy($id);
            DB::commit();
            return $this->redirectSuccess(__('general.delete-content', ['contenido' => 'Usuario']));
        }
        DB::rollback();
        return $this->redirectFailed(__('general.error-content', ['contenido' => 'Usuario']));
    }
}
