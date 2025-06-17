<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Entrada extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'localidad_id', 'estado', 'codigo_qr'];


    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function localidad()
    {
        return $this->belongsTo(Localidad::class);
    }
    public function puedeReembolsar()
    {
        return $this->estado === 'comprado' && $this->user_id === Auth::id();
    }
}

