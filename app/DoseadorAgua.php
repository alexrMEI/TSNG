<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoseadorAgua extends Model
{
	protected $table = 'doseadores_agua';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'temperatura', 'quantidade', 'identificador', 'last_update'
    ];
}
