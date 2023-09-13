<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Conductores_Camiones extends Model
{
    use HasFactory;
    protected $table = 'conductores_camiones';


    protected $fillable = [
        'id_camion',
        'id_conductor'
        
    ];




    protected function name():Attribute{

        return new Attribute(
    
            get:fn($value) => ucwords($value),
            set: fn($value) => strtolower($value)
            
        );

    }



    public function camion()
    {
        return $this->belongsTo(Camiones::class,'id_camion');
    }

    public function conductor()
    {
        return $this->belongsTo(User::class,'id_conductor');
    }
}
