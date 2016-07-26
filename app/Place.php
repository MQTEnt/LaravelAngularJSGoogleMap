<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
	protected $table='places';
	protected $fillable=['name','lat','lon','description','votes','status'];
}
