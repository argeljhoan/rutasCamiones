<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruta extends Model
{
    use HasFactory;
    protected $table = 'rutas';

    protected $fillable = [
        'latitud',
        'longitud',
        'id_camion'
        
    ];


    public function camion()
    {
        return $this->belongsTo(Camiones::class,'id_camion');
    }
}
