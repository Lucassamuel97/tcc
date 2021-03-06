<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
	protected $fillable = ['manufacturer','status','description','identification_number','engine_number','serial_number','mounting_number','year_manufacture','model','hodometro'];
	protected $table = 'machines'; 

	public function relMaintenances(){
		return $this->hasMany('App\Models\Maintenance','machine_id');
	}

	public function relHodometroUpdates(){
		return $this->hasMany('App\Models\UpdateHodometro','machine_id');
	}

}
