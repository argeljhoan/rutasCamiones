<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;

class User extends Authenticatable
{

    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'identificacion',
        'telefono',
        'id_acceso',
        'id_asignacion',
        'profile_photo_path',

        
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

      protected function name():Attribute{

        return new Attribute(
    
            get:fn($value) => ucwords($value),
            set: fn($value) => strtolower($value)
            
        );

    }

    public function acceso()
    {
        return $this->belongsTo(Acceso::class,'id_acceso');
    }

    
    public function asignacion()
    {
        return $this->belongsTo(Asignacion::class,'id_acceso');
    }

    // public function roles()
    // {
    //     return $this->belongsToMany(Role::class, 'model_has_roles', 'model_id', 'role_id');
    // }

    public function camiones()
    {
        return $this->hasMany(Camiones::class, 'id_conductor');
    }

    public function conductorCamiones()
    {
        return $this->hasMany(Conductores_Camiones::class, 'id_conductor');
    }


    public function models()
    {
        return $this->hasMany(Model_has_role::class, 'model_id');
    }
    


}
