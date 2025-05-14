<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Factories\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasMany;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /** @use HasFactory<\Database\Factories\ItemFactory> */
    use HasFactory;

    protected $fillable =[
    	'user_id',
    	'cate_id',
    	'item',
    	'price',
    	'barcode'
    ];

	public function category()
    {
    	return $this->belongsTo(Category::class);
    }

	public function user()
    {
    	return $this->belongsTo(User::class);
    }

}
