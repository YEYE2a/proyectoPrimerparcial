<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Localidad extends Model
{
    use HasFactory;
    protected $fillable = ['evento_id', 'nombre', 'precio', 'capacidad'];

    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }

    public function entradas()
    {
        return $this->hasMany(\App\Models\Entrada::class);
    }
}
