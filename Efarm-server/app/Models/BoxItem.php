<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BoxItem extends Model
{
	protected $table = "boxes_items";

	protected $fillable = [
        'box_id', 
        'vegetable_id',
        'weight'
    ];
}
