<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
	protected $table='reviews';
	protected $fillable=['title','content','tags','user_id','place_id'];
}
