<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
    ];
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

    public function shoppings()
    {
        return $this->hasMany(Shopping::class);
    }
}
