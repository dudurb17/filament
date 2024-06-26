<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Address extends Model
{
    use HasFactory;
    protected $table = 'address';

    protected $fillable = [
        'userId',
        'name',
        'street',
        'number',
        'neighborhood'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'userId');
    }

    public function category(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_address', 'addressId', 'categoryId')->withTimestamps();
    }
}