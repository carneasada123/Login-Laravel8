<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Persona extends Authenticatable
{
    use Notifiable;

    protected $table = 'persona';
    protected $primaryKey = 'pk_persona';

    protected $fillable = [
        'correo', 'clave', 'nombre',
    ];

    protected $hidden = [
        'clave', 'remember_token',
    ];

    public function getAuthPassword()
    {
        return $this->clave;
    }
}
