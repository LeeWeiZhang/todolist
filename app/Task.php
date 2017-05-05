<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
	protected $table = 'tasks';
    
    /*public function tasklist()
    {
    	return $this->belongsTo('App\TaskList');
    }*/
}
