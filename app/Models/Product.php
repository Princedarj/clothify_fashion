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
        return $this->belongsTo(Category::class, 'category_id');
    }


    public function getName()
    {
        return match (app()->getLocale()) {
            'hi' => $this->name_hi ?: $this->name_en,
            'gu' => $this->name_gu ?: $this->name_en,
            default => $this->name_en,
        };
    }
    public function getDescription()
    {
        return match (app()->getLocale()) {
            'hi' => $this->description_hi ?: $this->description_en,
            'gu' => $this->description_gu ?: $this->description_en,
            default => $this->description_en,
        };
    }

}


