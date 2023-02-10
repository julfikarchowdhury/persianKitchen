<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Enums\CategoryStatusEnum;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'details',
        'image_url',
        'status'
    ];
    protected $casts = [
        'status' => CategoryStatusEnum::class
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

    /**
     * relation with category table
     */
    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }
}
