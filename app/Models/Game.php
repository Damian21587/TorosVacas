<?php

namespace App\Models;

use App\Auth\PostSave;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use PostSave;
    use HasFactory;

    public $table = 'games';

    public $fillable = [
        'secret_number',
        'guess',
        'age',
        'bulls',
        'cows',
        'attempts',
        'won',
        'evaluation',
        'user_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'bulls' => 'integer',
        'cows' => 'integer',
        'attempts' => 'integer',
        'evaluation' => 'float',
        'guess' => 'string',
        'age' => 'string',
        'secret_number' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'age' => 'required|integer',
        'guess' => 'required|integer|min:4',
        'user_id' => 'required',
    ];

    public function user() {
        return $this->belongsTo(User::class,'user_id');
    }
}
