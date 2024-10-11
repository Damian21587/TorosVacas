<?php

namespace App\Models;

use App\Auth\PostSave;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    use PostSave;

    protected $guarded = [];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public static function generateFor($table_name, $display, $created_by)
    {
        static::firstOrCreate(['name' => $table_name . '.index', 'name_table' => $table_name, 'name_action' => 'Navegar en ' . _($display), 'created_by' => $created_by]);
        static::firstOrCreate(['name' => $table_name . '.show', 'name_table' => $table_name, 'name_action' => 'Ver detalles de ' . _($display), 'created_by' => $created_by]);
        static::firstOrCreate(['name' => $table_name . '.edit', 'name_table' => $table_name, 'name_action' => 'Editar ' . _($display), 'created_by' => $created_by]);
        static::firstOrCreate(['name' => $table_name . '.create', 'name_table' => $table_name, 'name_action' => 'Crear ' . _($display), 'created_by' => $created_by]);
        static::firstOrCreate(['name' => $table_name . '.destroy', 'name_table' => $table_name, 'name_action' => 'Eliminar ' . _($display), 'created_by' => $created_by]);
    }

    public static function removeFrom($table_name)
    {
        static::where(['name_table' => $table_name])->delete();
    }
}
