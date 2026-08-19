<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products=Product::with('category')->paginate(10);
        return view('admin.products.product',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=Category::all();
        return view('admin.products.product_create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();
        if($request->hasFile('image')){
            $path=$request->file('image')->store('photos','public');
            $data['image']=$path;
        }
        Product::create($data);
        return redirect()->route('product');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories=Category::all();
        return view('admin.products.productes_edit',compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->name=$request->name;
        $product->price=$request->price;
        $product->oldPrice=$request->oldPrice;
        $product->category_id=$request->category_id;
        $product->description=$request->description;
        if($request->hasFile('image')){
            $path=$request->file('image')->store('photos','public');
            $product->image=$path;
        }
        $product->save();
        return redirect()->route('product');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product');
    }

    public function featured(Product $product)
    {
        Product::where('is_featured', 1)->update(['is_featured' => 0]);

        $product->update(['is_featured' => 1]);

        return response()->json([
            'success' => true,
            'message' => 'تم تعيين المنتج كمنتج مميز بنجاح.'
        ]);
    }



    public function applyDiscount(Request $request, Product $product)
    {
        // 1. إذا كان المنتج عليه عرض حالياً، نقوم بإلغائه وإرجاع السعر الأصلي الكامل
        if ($product->is_flash_sale) {
            $product->update([
                'is_flash_sale' => 0,
                'discount_percentage' => null,
                'price' => $product->oldPrice // يعود السعر الحالي ليتساوى مع السعر الأصلي القديم
            ]);

            return response()->json([
                'success' => true,
                'is_flash_sale' => 0,
                'discount_percentage' => null,
                'message' => 'تم إلغاء العرض وإعادة السعر الأصلي بنجاح.'
            ]);
        }
        
        // 2. إذا كان المنتج ليس عليه عرض، نتحقق من صحة النسبة الممررة من الـ JavaScript
            $request->validate([
                'discount_percentage' => 'required|integer|min:1|max:100'
            ]);
            $old_price=$product->price;
            $percentage = $request->discount_percentage;

            $newCurrentPrice = $product->price - ($product->price * ($percentage / 100));

        // 4. تحديث البيانات في الجدول
            $product->update([
                'is_flash_sale' => 1,
                'discount_percentage' => $percentage,
                'oldPrice' =>$old_price,
                'price' => round($newCurrentPrice, 2) // تقريب السعر لخانة عشرية ثنائية (مثل: 10.99)
            ]);

        // 5. إرجاع استجابة JSON سريعة ليستقبلها كود الـ JavaScript لتحديث واجهة المستخدم فوراً
            return response()->json([
                'success' => true,
                'is_flash_sale' => 1,
                'discount_percentage' => $product->discount_percentage,
                'message' => 'تم تطبيق نسبة التخفيض وتحديث السعر بنجاح.'
            ]);
    }







}
