<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.dashboard.dashboard', [
            'totalSales' => Order::where('payment_status', 'paid')->sum('total_price'),
            'ordersCount' => Order::count(),
            'newOrderToday' => Order::whereDate('created_at',today())->count(),

            'pendingOrderToday' => Order::where('status','pending')->whereDate('created_at',today())->count(),
            'todayCompletedOrders' => Order::where('status','delivered')->whereDate('created_at',today())->count(),
            'todayShippedOrders' => Order::where('status','shipped')->whereDate('created_at',today())->count(),
            'totalSalestoday' => Order::where('payment_status', 'paid')->whereDate('created_at',today())->sum('total_price'),

            'productsCount' => Product::count(),

            'usersCount' => User::count(),
            'newUsersToday' => User::whereDate('created_at', today())->count(),

            'lastUsers'=>User::whereDate('created_at', today())->paginate(5)
        ]);
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
