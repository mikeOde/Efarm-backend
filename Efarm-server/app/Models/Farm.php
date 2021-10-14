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
        'owner_first_name',
        'owner_last_name',
        'address_id',
        'farm_has_badges',
        'review_id',
        'image',
    ];
}
