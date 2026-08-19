<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class orderItem extends Model
{
    protected $guarded = ['id','created_at','updated_at'];
    public function product(): BelongsTo
    {
        // لارافيل سيربط تلقائياً حقل product_id في عنصر الطلب مع id في جدول المنتجات
        return $this->belongsTo(Product::class); 
    }
}
