<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chart extends Model
{
    public $timestamps = false;    
    protected $table = 'chart';
    
    protected $fillable = [
        'name', 'type', 'public', 'user_id'
    ];

    public function fields()
    {
        return $this->hasMany('App\ChartField');
    }

}
