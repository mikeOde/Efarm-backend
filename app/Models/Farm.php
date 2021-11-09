<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Farm extends Model
{
	protected $table = "farms";

	protected $fillable = [
        'farm_name', 
        'description',
        'owner_id',
        'location',
        'image',
        'lat',
        'lng'
    ];

    public function user()
        {
            return $this->belongsTo(User::class);
        }
}