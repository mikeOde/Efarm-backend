<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TreeAdoption extends Model
{
	protected $table = "trees_adoptions";

	protected $fillable = [
        'user_id', 
        'tree_id'         
    ];

    public function user()
        {
		    return $this->belongsTo(User::class);
	    }
}
