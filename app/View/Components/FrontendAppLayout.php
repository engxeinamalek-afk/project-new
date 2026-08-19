<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Category;
class FrontendAppLayout extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
     public function render(): View
    {
        // 2. جلب جميع الفئات من قاعدة البيانات
        $navbarCategories = Category::all();

        // 3. تمريرها عبر دالة with لملف الـ Blade الرئيسي
        return view('layouts.frontend.app')->with('navbarCategories', $navbarCategories);
    }
}
