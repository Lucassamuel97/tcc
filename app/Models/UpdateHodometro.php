<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UpdateHodometro extends Model{
    protected $fillable = ['maintenance_id','user_id','hodometro'];
	protected $table = 'update_hodometros'; 

	public function relUsers(){
		return $this->hasOne('App\User','id','user_id');
    }
}
