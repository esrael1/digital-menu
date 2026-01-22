<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
     use HasFactory;
    protected $fillable = [
        'category_id',
        'item_name',
        'price',
        'tax_percentage',
        'final_price',
        'photo'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

