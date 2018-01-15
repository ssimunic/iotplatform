<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChartField extends Model
{
    public $timestamps = false;    
    protected $table = 'chart_field';
    
    protected $fillable = [
        'name', 'chart_id', 'device_field_id'
    ];

    public function deviceField()
    {
        return $this->belongsTo('App\DeviceField');
    }

    public function chart()
    {
        return $this->belongsTo('App\Chart');
    }
}
