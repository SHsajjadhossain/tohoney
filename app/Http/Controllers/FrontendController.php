<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        return view('frontend.index', [
            'categories' => Category::where('status', 'show')->get(),
            'all_products' => Product::all(),
        ]);
    }
}
