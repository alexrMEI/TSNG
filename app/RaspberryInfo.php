<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RaspberryInfo extends Model
{
	protected $table = 'raspberry_info';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'rasp_ip', 'key'
    ];
}
