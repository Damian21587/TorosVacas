<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserTableSeeder extends Seeder
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
                'email' => 'admin@bullscows.cu',
                'password' => bcrypt('password'),
                'remember_token' => Str::random(60),
                'role_id' => $role->id
            ]);
        }
    }
}
