<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trigger extends Model
{
    public $timestamps = false;    
    protected $table = 'trigger';
    
    protected $fillable = [
        'max_value', 'min_value', 'email', 'webhook_url', 'device_field_id'
    ];

    public function deviceField()
    {
        return $this->belongsTo('App\DeviceField');
    }

}
