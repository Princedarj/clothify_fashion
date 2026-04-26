<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_en',
        'name_hi',
        'name_gu',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getName()
    {
        $locale = app()->getLocale();

        return match ($locale) {
            'hi' => $this->name_hi,
            'gu' => $this->name_gu,
            default => $this->name_en,
        };
    }
}