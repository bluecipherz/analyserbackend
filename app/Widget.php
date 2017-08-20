<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Widget extends Model
{

	protected $fillable = array(
        'miles',
        'fuel',
        'time'
    );
}
