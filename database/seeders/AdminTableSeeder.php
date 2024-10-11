<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (0 == User::count()) {
            $role = Role::where('name', 'Editor')->firstOrFail();
            User::create([
                'name' => 'Admin',
                'email' => 'admin@cascaron.cu',
                'password' => bcrypt('password'),
                'remember_token' => Str::random(60),
                'role_id' => $role->id,
                'created_by' => 'Admin'
            ]);
        }
    }
}
