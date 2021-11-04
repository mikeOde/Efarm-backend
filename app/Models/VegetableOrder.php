<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VegetableOrder extends Model
{
	protected $table = "vegetables_orders";

	protected $fillable = [
        'user_id', 
        'vegetable_id'         
    ];

    public function user()
        {
		    return $this->belongsTo(User::class);
	    }
}
