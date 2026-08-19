<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\orderItem;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Order extends Model
{
    protected $guarded = ['id'];
    public function items(): HasMany
    {
        // لارافيل سيبحث تلقائياً عن حقل order_id داخل جدول order_items
        return $this->hasMany(OrderItem::class); 
    }
}
