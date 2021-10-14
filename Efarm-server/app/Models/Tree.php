<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tree extends Model
{
	protected $table = "trees";

	protected $fillable = [
        'name', 
        'description',
        'owner_id',
        'quantity',
        'price',
        'image',
    ];
}
