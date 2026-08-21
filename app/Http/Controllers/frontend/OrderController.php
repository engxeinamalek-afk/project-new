<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\cartItems;
use App\Models\Order;
use App\Models\orderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id=Auth::id();
        $orders=Order::where('user_id',$user_id)->with('items.product')->paginate(10);
        return view('user.orders',compact('orders'));
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
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Unauthenticated.'], 401);
        }

        $products = $this->getProduct();
        if($products->isEmpty()){
            return ;
        } 
        $totalPrice = $products->sum(function($product) {
            return $product->price * $product->quantity;
        });
        DB::beginTransaction();
        try{
            $order= Order::create(['user_id' => Auth::id(),
                            'total_price' => $totalPrice,
                            'payment_status' => 'paid',
                            'status' => 'processing'
                            ]);
            foreach($products as $product){
                orderItem::create(['order_id' => $order->id,
                                'product_id' => $product->id,
                                'quantity' => $product->quantity,
                                'unit_price' => $product->price
                                ]);
            }
            $cart=Cart::where('user_id',Auth::id())->first();
            cartItems::where('cart_id',$cart->id)->delete();
            DB::commit();
            return response()->json([ 'success' => true,
                                      'message' => 'Payment completed and order created successfully!']);
        }catch(Exception $e){
            DB::rollBack();
            return response()->json(['success' => false,
                                    'message' => 'Sorry, an error occurred while processing your request:' . $e->getMessage()], 500);
        }

    }

    private function getProduct(){
        if(Auth::check()){
            $cart=Cart::where('user_id',Auth::id())->first();
            return Product::join('cart_items','products.id','=','cart_items.product_id')
                   ->where('cart_items.cart_id','=',$cart->id)
                   ->orderBy('cart_items.updated_at','desc')
                   ->select('products.*','cart_items.quantity as quantity')
                   ->get();
        }
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


