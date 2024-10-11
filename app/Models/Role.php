<?php

namespace App\Models;

use App\Auth\PostSave;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    use PostSave;

    protected $guarded = [];
    protected $fillable = ['name'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function permisos()
    {
        return $this->belongsToMany(Permission::class,
            'permission_roles','role_id','permission_id');
    }
}
