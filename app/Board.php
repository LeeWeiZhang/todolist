<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    protected $table = 'boards';
    
    public function user()
    {
        return $this->belongsTo('App\User','owner');
    }

    public function list()
    {
    	return $this->hasMany('App\List', 'board', 'id');
    }
}
