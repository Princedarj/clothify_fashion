<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = [
    'name',

    'name_en',
    'name_hi',
    'name_gu',

    'description',

    'description_en',
    'description_hi',
    'description_gu',

    'price',
    'image',
    'category_id'
];

public function category()
{
    return $this->belongsTo(Category::class);
}

}


