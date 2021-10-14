<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
	protected $table = "boxes";

	protected $fillable = [
        'name', 
        'description',
        'owner_id',
        'quantity',       // quantity of boxes available
        'price',          // per box 
    ];
}
