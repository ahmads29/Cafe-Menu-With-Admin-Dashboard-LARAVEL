<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'subsubcategory_id',
        'price',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationship with category
    public function subsubcategory()
    {
        return $this->belongsTo(Subsubcategory::class);
    }
}
