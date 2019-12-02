<?php

namespace App;

use Illuminate\Support\Facades\DB;

class Animal
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome', 'peso', 'raca', 'idade', 'tipo_animal', 'user_id', 'doseador_agua_id', 'doseador_comida_id'
    ];
}
