<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Product extends Model
{
    protected $guarded = ['id'];
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }
    public function favoritedByUsers()
    {
        return $this->belongsToMany(User::class, 'favorites', 'product_id', 'user_id');
    }

}
