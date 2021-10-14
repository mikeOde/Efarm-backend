<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vegetable extends Model
{
	protected $table = "vegetables";

	protected $fillable = [
        'name', 
        'description',
        'owner_id',
        'quantity',
        'price',
        'image',
    ];
}