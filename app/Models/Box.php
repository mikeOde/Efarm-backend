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
        'created_by_user_id',
        'quantity',       // quantity of boxes available
        'price',          // per box 
    ];

    public function user()
        {
		    return $this->belongsTo(User::class);
	    }
    public function boxitem()
        {
            return $this->hasMany(BoxItem::class);
        }
}
