<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	protected $table = "orders";

	protected $fillable = [
        'user_id', 
        'owner_id',     
        'box_id',
        'customer_address_id',
        'quantity',       // quantity of boxes available
        'price',          // per box 
    ];

    public function user()
        {
		    return $this->belongsTo(User::class);
	    }
}
