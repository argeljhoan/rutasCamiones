<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Camiones extends Model
{
    use HasFactory;
    protected $table = 'camiones';


   
    protected $fillable = [
        'profile_photo_path',
        'marca',
        'modelo',
        'color',
        'matricula',
        'id_estado',
        'id_tipo',
        'id_conductor'
        
    ];

    public function tipo_camion()
    {
        return $this->belongsTo(Tipo::class,'id_tipo');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class,'id_estado');
    }


    public function conductor()
    {
        return $this->belongsTo(User::class,'id_conductor');
    }


    protected function name():Attribute{

        return new Attribute(
    
            get:fn($value) => ucwords($value),
            set: fn($value) => strtolower($value)
            
        );

    }

}
