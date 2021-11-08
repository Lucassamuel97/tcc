<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    protected $fillable = ['description','machine_id','range_hodometro','range_months','last_hodometro','last_months','user_id'];
    protected $table = 'maintenances'; 
    
    public function relUser(){
		return $this->hasOne('App\User','id','user_id');
	}
}
