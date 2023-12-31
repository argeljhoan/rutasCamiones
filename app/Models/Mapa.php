<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapa extends Model
{
    use HasFactory;
    protected $table = 'mapa';


   
    protected $fillable = [
        'latitud',
        'longitud',
        'estadoLaboral',
        'estadoSituacion',
        'direccion',
        'id_camion',
        
    ];


    public function camion()
    {
        return $this->belongsTo(Camiones::class,'id_camion');
    }
}
