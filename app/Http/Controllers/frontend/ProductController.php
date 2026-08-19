<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\RecentlyViewed;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\Models\Favorite;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function viewDetails(Product $product)
    {
        $maxItems = 20; // أقصى عدد منتجات نريد حفظه
        $cookieName = 'recently_viewed_products';
        $duration = 576000; // 400 يوم بالدقائق

        if (Auth::check()) {
            // المستخدم مسجل دخول
            $userId = Auth::id();
        
            RecentlyViewed::updateOrCreate(
                //ابحث عن سجل يحتوي على هذا المستخدم وهذا المنتج
                ['user_id' => $userId, 'product_id' => $product->id],
    
                //تحديث وقت المشاهدة للوقت الحالي
                ['updated_at' => now()]
            );

            // تنظيف الجدول ليبقى فقط آخر 5 منتجات للمستخدم
            $latestViewedIds = RecentlyViewed::where('user_id', $userId)
                ->latest()
                ->take($maxItems)
                ->pluck('id');
            RecentlyViewed::where('user_id', $userId)
                ->whereNotIn('id', $latestViewedIds)
                ->delete();
            // إذا كان المستخدم مسجل دخول: افحص وجوده في جدول المفضلة الوسيط
            $product->is_favorite = $product->favoritedByUsers()
                ->where('user_id', Auth::id())
                ->exists();

        } else {
            //  لمعرفة هل المنتج مفضل إذا كان زائر: افحص مصفوفة الكوكيز
            $favoriteIds = json_decode(request()->cookie('favorite_products', '[]'), true);
            $product->is_favorite = in_array($product->id, $favoriteIds);
            // تحويل محتوى الcookie الى مصفوفة وان لم تكن موجود نرجع مصفوفة فارغة
            $viewedIds = json_decode(request()->cookie($cookieName, '[]'), true);

            // إزالة المعرف إذا تكرر وإضافته في البداية
            if (($key = array_search($product->id, $viewedIds)) !== false) {
                unset($viewedIds[$key]);
            }
            array_unshift($viewedIds, $product->id);
        
            // قص المصفوفة لتأخذ أحدث 5 منتجات فقط
            $viewedIds = array_slice($viewedIds, 0, $maxItems);

            // حفظ الكوكيز وإرسالها للمتصفح (ستتجدد صلاحيتها لـلقيمة المحددة بالدقائق)
            Cookie::queue($cookieName, json_encode($viewedIds), $duration);
        }
        return view('user.product_details', compact('product'));
    }

    public function favoriteProduct(Product $product)
    {
        $maxItems = 20; // أقصى عدد منتجات نريد تفضيله
        $cookieName = 'favorite_products';
        $duration = 576000; // 400 يوم بالدقائق

        if (Auth::check()) {
            // المستخدم مسجل دخول
            $userId = Auth::id();
    
            // فحص ما إذا كان المنتج موجوداً مسبقاً في المفضلة لهذا المستخدم
            $existingFavorite = Favorite::where('user_id', $userId)
                ->where('product_id', $product->id)
                ->first();

            if ($existingFavorite) {
                // إذا كان موجوداً، نقوم بإزالته (إلغاء التفضيل)
                $existingFavorite->delete();
                return response()->json(['message' => 'تمت إزالة المنتج من المفضلة', 'is_favorite' => false]);
            } else {
                // إذا لم يكن موجوداً، نقوم بإضافته وتحديث الوقت
                Favorite::create([
                    'user_id' => $userId,
                    'product_id' => $product->id,
                    'updated_at' => now()
                ]);

                // تنظيف الجدول ليبقى فقط آخر 20 منتجاً مفضلاً للمستخدم
                $latestIds = Favorite::where('user_id', $userId)
                    ->latest('updated_at')
                    ->take($maxItems)
                    ->pluck('id');
                
                Favorite::where('user_id', $userId)
                    ->whereNotIn('id', $latestIds)
                    ->delete();

                return response()->json(['message' => 'تمت إضافة المنتج إلى المفضلة', 'is_favorite' => true]);
            }

        } else {
            // للمستخدم الزائر: تحويل محتوى الـ cookie إلى مصفوفة
            $favoriteIds = json_decode(request()->cookie($cookieName, '[]'), true);

            // فحص إذا كان معرف المنتج موجوداً في مصفوفة الكوكيز
            if (($key = array_search($product->id, $favoriteIds)) !== false) {
                unset($favoriteIds[$key]);
                // إعادة ترتيب مفاتيح المصفوفة بعد الحذف لتجنب تحولها إلى Object في JSON
                $favoriteIds = array_values($favoriteIds);
            
                Cookie::queue($cookieName, json_encode($favoriteIds), $duration);
                return response()->json(['message' => 'تمت إزالة المنتج من المفضلة', 'is_favorite' => false]);
            } else {
                // إذا لم يكن موجوداً، نضعه في بداية المصفوفة
                array_unshift($favoriteIds, $product->id);
        
                // قص مصفوفة الكوكيز لتأخذ أحدث 20 منتجاً فقط
                $favoriteIds = array_slice($favoriteIds, 0, $maxItems);

                Cookie::queue($cookieName, json_encode($favoriteIds), $duration);
                return response()->json(['message' => 'تمت إضافة المنتج إلى المفضلة', 'is_favorite' => true]);
            }
        }
    }

}
