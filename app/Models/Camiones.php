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
        'id_color',
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


     public function color()
    {
        return $this->belongsTo(Color::class,'id_color');
    }

     public function tickects()
    {
        return $this->hasMany(Ticket::class, 'id_conductor');
    }

    public function mapas()
    {
        return $this->hasMany(Mapa::class, 'id_camion');
    }

     public function rutas()
    {
        return $this->hasMany(Ruta::class, 'id_camion');
    }

    protected function matricula():Attribute{

        return new Attribute(
    
            get:fn($value) => strtoupper($value),
            set: fn($value) => strtolower($value)
            
        );

    }

}
