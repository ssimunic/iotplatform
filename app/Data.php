<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    public $timestamps = false;    
    protected $table = 'data';
    
    protected $fillable = [
        'value', 'datetime', 'device_field_id'
    ];


}
