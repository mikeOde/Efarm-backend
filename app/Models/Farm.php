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
        'location',
        'image',
    ];

    public function user()
        {
            return $this->belongsTo(User::class);
        }
}