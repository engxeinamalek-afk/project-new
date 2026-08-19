<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories=Category::paginate(10);
        return view('admin.categories.category',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.category_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $data = $request->validated();
        if($request->hasFile('image')){
            $path=$request->file('image')->store('photos','public');
            $data['image']=$path;
        }
        Category::create($data);
        return redirect()->route('category');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.categories_edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->name=$request->name;
        $category->description=$request->description;
        if($request->hasFile('image')){
            $path=$request->file('image')->store('photos','public');
            $category->image=$path;
        }
        $category->save();
        return redirect()->route('category');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->products()->delete();
        $category->delete();
        return redirect()->route('category');
    }

    public function featured(Category $category)
    {
        Category::where('is_featured', 1)->update(['is_featured' => 0]);

        $category->update(['is_featured' => 1]);

        return response()->json([
            'success' => true,
            'message' => 'تم تعيين الفئة كفئة مميزة بنجاح.'
        ]);
    }

}
