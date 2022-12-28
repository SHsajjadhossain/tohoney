<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Rating;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        return view('frontend.index', [
            'categories' => Category::where('status', 'show')->get(),
            'all_products' => Product::latest()->limit(8)->get(),
        ]);
    }

    public function productdetails($slug)
    {
        $wishlist_status = Wishlist::where('user_id', auth()->id())->where('product_id', Product::where('product_Slug', $slug)->first()->id)->exists();
        if ($wishlist_status) {
            $wishlist_id = Wishlist::where('user_id', auth()->id())->where('product_id', Product::where('product_Slug', $slug)->first()->id)->first()->id;
        }
        else{
            $wishlist_id = "";
        }

        $related_product = Product::where('product_slug', '!=', $slug)->where('category_id', Product::where('product_slug', $slug)->firstOrFail()->category_id)->limit(4)->get();
        return view('frontend.productdetails',[
            'single_product_info' => Product::where('product_slug', $slug)->firstOrFail(),
            'related_products' => $related_product,
            'wishlist_status' => $wishlist_status,
            'wishlist_id' => $wishlist_id,
            'reivews' => Rating::where('product_id', Product::where('product_slug', $slug)->firstOrFail()->id)->get(),
        ]);
    }

    public function shoppage()
    {
        return view('frontend.shoppage',[
            'categories' => Category::all(),
            'products' => Product::all(),
        ]);
    }
}
