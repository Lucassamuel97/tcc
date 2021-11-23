<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaintenancePostpone extends Model{
    protected $fillable = ['maintenance_id','user_id','postpone_months','postpone_hodometro','note'];
		protected $table = 'maintenance_postpones'; 

		public function relUsers(){
			return $this->hasOne('App\User','id','user_id');
    }
    
    public function relMaintenances(){
			return $this->hasOne('App\Models\Maintenance','id','maintenance_id');
		}
}
