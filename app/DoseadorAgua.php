<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doseador_agua extends Model
{
	protected $table = 'doseadores_agua';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'temperatura', 'distancia', 'filling'
    ];
}
