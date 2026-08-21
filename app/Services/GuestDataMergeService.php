<?php

namespace App\Services;
use App\Models\Cart;
use App\Models\cartItems;
use App\Models\Product;
use Illuminate\Support\Facades\Cookie;
use App\Models\RecentlyViewed;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class GuestDataMergeService
{
    /**
     * Create a new class instance.
     */
    public function merge(Request $request){
        DB::transaction(function() use ($request) {
            $this->mergeCart($request);
            $this->mergeFavorites($request);
            $this->mergeRecentlyViewed($request);
        });

    }
    private function mergeCart(Request $request){
        $cookieCart = json_decode($request->cookie('cartItems', '[]'),true);
        if (!empty($cookieCart)) {
            $cart = Cart::firstOrCreate([
                'user_id' => Auth::id()
            ]);
            foreach ($cookieCart as $productId => $quantity) {
                $product=Product::find($productId);
                if(!$product)   continue;
                if(!is_numeric($quantity)|| $quantity<=0)   continue;
                $cartItem = cartItems::where('cart_id', $cart->id)
                ->where('product_id', $productId)
                ->first();
                if ($cartItem) {
                    $cartItem->increment('quantity', $quantity);
                } else {
                    cartItems::create([
                        'cart_id' => $cart->id,
                        'product_id' => $productId,
                        'quantity' => $quantity,
                    ]);
                }       
            }
            Cookie::queue(Cookie::forget('cartItems'));
        }
    }
    private function mergeFavorites(Request $request){
        $favoriteIds = json_decode($request->cookie('favorite_products', '[]'),true);
        if (!empty($favoriteIds)) {
            foreach ($favoriteIds as $productId) {
                $product = Product::find($productId);
                if (!$product)  continue;
                Favorite::updateOrCreate(['user_id' => Auth::id(),
                        'product_id' => $productId,]    ,   ['updated_at' => now()]);
            }
            $latestIds = Favorite::where('user_id', Auth::id())->latest('updated_at')->take(20)->pluck('id');
            Favorite::where('user_id', Auth::id())->whereNotIn('id', $latestIds)->delete();
            Cookie::queue(Cookie::forget('favorite_products'));
        }
    }
    private function mergeRecentlyViewed(Request $request){
        $recentlyViewed = json_decode($request->cookie('recently_viewed_products', '[]'),true);
        if (!empty($recentlyViewed)) {
            foreach ($recentlyViewed as $productId) {
                $product = Product::find($productId);
                if (!$product)  continue;
                RecentlyViewed::updateOrCreate([
                        'user_id' => Auth::id(),
                        'product_id' => $productId,]    ,   ['updated_at' => now()]);
            }
            $latestIds = RecentlyViewed::where('user_id', Auth::id())->latest('updated_at')
                ->take(20)
                ->pluck('id');
            RecentlyViewed::where('user_id', Auth::id())->whereNotIn('id', $latestIds)->delete();
            Cookie::queue(Cookie::forget('recently_viewed_products'));
        }
    }
    public function __construct()
    {
        //
    }
}
