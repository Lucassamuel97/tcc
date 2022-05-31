<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UpdateHodometro extends Model{
    protected $fillable = ['machine_id','user_id','hodometro'];
	protected $table = 'update_hodometros'; 

	public function relUser(){
		return $this->hasOne('App\User','id','user_id');
	}

	public function relMachine(){
		return $this->hasOne('App\Models\Machine','id','machine_id');
 	}
}
