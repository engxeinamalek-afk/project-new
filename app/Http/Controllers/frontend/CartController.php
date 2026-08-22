<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\cartItems;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->getProduct();
        $totalPrice = $products->sum(function($product) {
            return $product->price * $product->quantity;
        });
        return view('user.cart', compact('products','totalPrice'));
    }
    private function getProduct(){
        if(Auth::check()){
            $cart=Cart::where('user_id',Auth::id())->first();
            if(!$cart){
                return collect();
            }
            return Product::join('cart_items','products.id','=','cart_items.product_id')
                   ->where('cart_items.cart_id','=',$cart->id)
                   ->orderBy('cart_items.updated_at','desc')
                   ->select('products.*','cart_items.quantity as quantity')
                   ->get();
        }
        $cookieName = 'cartItems';
        $cartItems = json_decode(request()->cookie($cookieName, '[]'), true);
        $productIds= array_keys($cartItems);
        $products = Product::whereIn('id',$productIds)->get();
        foreach($products as $product){
            $product->quantity = $cartItems[$product->id];
        }
        return $products;

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
    public function store(Request $request , Product $product)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);
        if (Auth::check()) {
            $userId = Auth::id();
            $cart = Cart::firstOrCreate([
                'user_id' => $userId
            ]);
            $cartItem= cartItems::where(['cart_id'    => $cart->id,
                                        'product_id' => $product->id])->first();
            if($cartItem){
                $cartItem->update(['quantity'   => DB::raw("quantity + " . (int)$request->quantity)]);
            }else{
                cartItems::create([
                    'cart_id'    => $cart->id,
                    'product_id' => $product->id,
                    'quantity'   => $request->quantity
                ]);
            }
        } else {
            $cookieName='cartItems';
            $duration=300;
            $cart = json_decode(request()->cookie($cookieName, '[]'), true);
            if(array_key_exists($product->id , $cart)){
                $cart[$product->id] += $request->quantity;
            }else{
                $cart[$product->id] = $request->quantity;
            }
            Cookie::queue($cookieName, json_encode($cart), $duration);
        }
        return response()->json([
            'success' => true,
            'message' => 'تمت إضافة المنتج إلى السلة بنجاح',
        ], 200);
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
