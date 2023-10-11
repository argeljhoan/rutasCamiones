<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'tickets';
  
    protected $fillable = [
        'radicado',
        'fecha',
        'hora',
        'procedencia',
        'destino',
        'despachador',
        'id_conductor',
        'pesoBruto',
        'pesoTara',
        'pesoNeto',
        'recibido',
        'fototicket',
    ];

    

    public function camion()
    {
        return $this->belongsTo(Camiones::class,'id_conductor');
    }
    
    
    
   


}
