<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doseador_comida extends Model
{
	protected $table = 'doseadores_comida';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'feeding', 'luminosidade', 'comer', 'altifalante'
    ];
}
