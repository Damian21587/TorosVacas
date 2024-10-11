<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermisoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //******Administracion y Contenido*********
        Permission::generateFor('roles','Roles','Admin');
        Permission::generateFor('users','Usuarios','Admin');
        Permission::generateFor('game','Juego de Toros y Vacas','Admin');

        //******Nomencladores*********

       /* //******Generador CRUD Laravel*********
        Permission::generateFor('infyOmGenerator','Generator Builder','AdminProgramador');*/

    }
}
