<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoseadorComida extends Model
{
	protected $table = 'doseadores_comida';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'vazio', 'identificador', 'last_update'
    ];
}
