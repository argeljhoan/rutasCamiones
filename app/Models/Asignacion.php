<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignacion extends Model
{
    use HasFactory;

    protected $table = 'asignacion';

    protected $fillable = [
        'name'
        
    ];

    public function users()
    {
        return $this->hasMany(User::class,'id_asignacion');
    }

}
