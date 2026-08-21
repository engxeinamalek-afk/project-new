<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecentlyViewed extends Model
{
    protected $table = 'recently_viewed'; 
    protected $guarded = ['id','created_at'];
}
