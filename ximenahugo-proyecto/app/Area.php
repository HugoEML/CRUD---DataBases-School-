<?php

namespace ProyectoLaravel;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
	protected $fillable = ['name','description','avatar'];
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
