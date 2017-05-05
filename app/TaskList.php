<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskList extends Model
{
    protected $table = 'lists';

    public function boards()
    {
    	return $this->belongsTo('App\Board', 'board');
    }

    public function task()
    {
    	return $this->hasMany('App\Task','list');
    }
}
