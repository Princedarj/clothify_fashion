<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_en',
        'name_hi',
        'name_gu',

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

    // 🔥 Add this function (VERY IMPORTANT)
    public function getName()
    {
        $locale = app()->getLocale();

        return match($locale) {
            'hi' => $this->name_hi,
            'gu' => $this->name_gu,
            default => $this->name_en,
        };
    }

    public function getDescription()
    {
        $locale = app()->getLocale();

        return match($locale) {
            'hi' => $this->description_hi,
            'gu' => $this->description_gu,
            default => $this->description_en,
        };
    }
}


