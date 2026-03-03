<?php

namespace App\Http\Controllers;

use App\Models\Product;

class FrontendController extends Controller
{
    public function home()
    {
        $products = Product::where('is_active',1)->get();
        return view('frontend.pages.home', compact('products'));
    }

    public function orderPage()
{
    $products = \App\Models\Product::where('is_active',1)->get();
    return view('frontend.pages.order', compact('products'));
}
}