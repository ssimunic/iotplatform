<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    public $timestamps = false;    
    protected $table = 'device';
    
    protected $fillable = [
        'name', 'mac_address', 'location', 'notes', 'last_check', 'read_time', 'api_key', 'user_id'
    ];

    public function fields()
    {
        return $this->hasMany('App\DeviceField');
    }

}
