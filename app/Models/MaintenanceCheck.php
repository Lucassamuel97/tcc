<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaintenanceCheck extends Model{
    protected $fillable = ['maintenance_id','user_id','price','note','hodometro'];
	protected $table = 'maintenance_checks'; 

	public function relUsers(){
		return $this->hasOne('App\User','id','user_id');
    }
    
    public function relMaintenances(){
		return $this->hasOne('App\Models\Maintenance','id','maintenance_id');
	}
}
