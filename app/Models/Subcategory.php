<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    //
    use HasFactory;

    protected $table = 'subcategories';

    protected $fillable = [
        'name',
        'category_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationship with category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function subsubcategories()
    {
        return $this->hasMany(Subsubcategory::class);
    }

}
