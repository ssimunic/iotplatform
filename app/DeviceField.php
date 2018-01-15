<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeviceField extends Model
{
    public $timestamps = false;    
    protected $table = 'device_field';
    
    protected $fillable = [
        'key', 'device_id'
    ];

    public function device()
    {
        return $this->belongsTo('App\Device');
    }

    public function triggers()
    {
        return $this->hasMany('App\Trigger');
    }

    public function data()
    {
        return $this->hasMany('App\Data');
    }

    public function chartFields()
    {
        return $this->hasMany('App\ChartField');
    }
}
