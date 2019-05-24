<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wen extends Model
{
    protected $table='wen';
    public $timestamps = true;
    const CREATED_AT = 'create_time';
 	const UPDATED_AT = false;
 	protected $guarded = [];

 	public function we(){
	 	return $this->belongsTo('App\Wz', 'w_id', 'w_id');
	}

}
