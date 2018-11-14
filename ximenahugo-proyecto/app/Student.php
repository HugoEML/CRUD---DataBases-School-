<?php

namespace ProyectoLaravel;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
	protected $fillable = ['name','lastname','ci','address','city','phone'];
     /**
	 * Get the route key for the model.
	 *
	 * @return string
	 */
	public function getRouteKeyName()
	{
	    return 'slug';
	}
}
