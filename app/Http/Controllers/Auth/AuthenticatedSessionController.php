<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Cart;
use App\Models\cartItems;
use App\Models\Product;
use Illuminate\Support\Facades\Cookie;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $cookieCart = json_decode($request->cookie('cartItems', '[]'),true);

        if (!empty($cookieCart)) {
            $cart = Cart::firstOrCreate([
                'user_id' => Auth::id()
            ]);
            foreach ($cookieCart as $productId => $quantity) {
                $product=Product::find($productId);
                if(!$product)   continue;
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
        if ($request->user()->role === 'admin') {
            return redirect('dashboard');
        }
        return redirect('/');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
