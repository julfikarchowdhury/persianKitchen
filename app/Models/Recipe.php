<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Recipe extends Model
{
    use HasFactory;

     protected $fillable = [
        'recipe_code',
        'category_id',
        'title',
        'details',
        'image',
        'video',
        'serving',
        'set_time',
        'tags',
        'created_by',
        'updated_by',
    ];
    public $timestamps = false;
    /**
     * boot function for created by and updated by
     * */
    public static function boot()
    {
        parent::boot();
        static::creating(function ($query) {
            $query->created_at = now();
            $query->updated_at = Null;
            if (Auth::check()) {
                $query->created_by = Auth::user()->id;
            }
        });

        static::updating(function ($query) {
            $query->updated_at = now();
            if (Auth::check()) {
                $query->updated_by = Auth::user()->id;
            }
        });
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    /**
     * relation with category table
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    /**
     * relation with ingredients table
     */
    public function ingredients()
    {
        return $this->hasMany(Ingredient::class);
    }
    /**
     * relation with directions table
     */
    public function directions()
    {
        return $this->hasMany(Direction::class);
    }
    /**
     * relation with favourite_recipes table
     */
    public function favourite_recipes()
    {
        return $this->hasMany(FavouriteRecipe::class);
    }
    /**
     * relation with recipe_feedbacks table
     */
    public function recipe_feedbacks()
    {
        return $this->hasMany(RecipeFeedback::class);
    }
    /**
     * relation with shopping table
     */
    public function shoppings()
    {
        return $this->hasManyThrough(Shopping::class, Ingredient::class);
    }
}
