<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $new_product=Product::latest()->paginate(3);
        if ($request->has('page')){
            return view('user.partials.new_product', compact('new_product'))->render();
        }
        $best_sellers = Product::with('category')
            ->select('products.*', DB::raw('SUM(order_items.quantity) as total_sold'))
            ->join('order_items', 'products.id', '=', 'order_items.product_id')
            ->groupBy('products.id')
            ->orderByDesc('total_sold')
            ->take(3)
            ->get();
        $onSale = Product::with('category')
            ->select('products.*', DB::raw('COALESCE(SUM(order_items.quantity), 0) as total_sold'))
            ->leftJoin('order_items', 'products.id', '=', 'order_items.product_id')
            ->where('products.is_flash_sale', '1') // جلب منتجات العرض فقط
            ->groupBy('products.id')
            ->get();
        $category=Category::where('is_featured','=','1')->first();
        $featured_product=Product::where('is_featured','=','1')->first();
        $viewedProducts=$this->getRecentlyViewedForHome();
        $favoriteProducts=$this->getFavoriteProducts();
        return view('user.home',compact('featured_product','new_product','best_sellers','onSale','category','viewedProducts','favoriteProducts'));
    }

    private function getRecentlyViewedForHome($limit = 20)
    {
        $cookieName = 'recently_viewed_products';

        // 1. إذا كان المستخدم مسجل دخول (نجلب من قاعدة البيانات)
        if (Auth::check()) {
            return Product::join('recently_viewed', 'products.id', '=', 'recently_viewed.product_id')
                ->where('recently_viewed.user_id', Auth::id())
                ->orderBy('recently_viewed.updated_at', 'desc')
                ->select('products.*')
                ->take($limit)
                ->get();
        }

        // 2. إذا كان زائر (نجلب من الكوكيز)
        $viewedIds = json_decode(request()->cookie($cookieName, '[]'), true);
        if (!empty($viewedIds)) {
            // نأخذ العدد المطلوب فقط من المعرفات
            $viewedIds = array_slice($viewedIds, 0, $limit);
            $idsString = implode(',', $viewedIds);
        
            // نجلب المنتجات بنفس ترتيب ظهورها في الكوكيز (الأحدث أولاً)
            return Product::whereIn('id', $viewedIds)
                ->orderByRaw("FIELD(id, $idsString)")//جلب المنتجات بالترتيب الموجود في الجلسة
                ->get();
        }

        return collect();
    }

    private function getFavoriteProducts($limit = 20)
    {
        $cookieName = 'favorite_products';

        if (Auth::check()) {
            return Product::join('favorites', 'products.id', '=', 'favorites.product_id')
                ->where('favorites.user_id', Auth::id())
                ->orderBy('favorites.updated_at', 'desc')
                ->select('products.*')
                ->take($limit)
                ->get();
        }

        $favoriteIds = json_decode(request()->cookie($cookieName, '[]'), true);
        if (!empty($favoriteIds)) {
            $favoriteIds = array_slice($favoriteIds, 0, $limit);
            $idsString = implode(',', $favoriteIds);
        
            return Product::whereIn('id', $favoriteIds)
                ->orderByRaw("FIELD(id, $idsString)")//جلب المنتجات بالترتيب الموجود في الجلسة
                ->get();
        }

        return collect();
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
