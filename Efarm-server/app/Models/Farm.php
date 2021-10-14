<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Farm extends Model
{
	protected $table = "farms";

	protected $fillable = [
        'name', 
        'description',
        'owner_id',
        'address_id',
        'farm_has_badges',
        'review_id',
        'image',
    ];
}