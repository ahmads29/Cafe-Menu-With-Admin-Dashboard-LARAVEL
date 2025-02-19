<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subsubcategory extends Model
{
    use HasFactory;

    protected $table = 'subsubcategories';

    protected $fillable = [
        'name',
        'subcategory_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationship with category
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    // Relationship with products
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
