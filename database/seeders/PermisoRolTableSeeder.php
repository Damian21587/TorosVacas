<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermisoRolTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleE = Role::where('name', 'Editor')->firstOrFail();

        $permissions = Permission::all();
        $roleE->permisos()->sync(
            $permissions->pluck('id')->all()
        );
    }
}
