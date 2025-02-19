<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = [
        'name',
        'icon',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }

    // Relationship with products
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
