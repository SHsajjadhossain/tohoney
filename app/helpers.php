<?php

use App\Models\Product;
use App\Models\User;

function allwishlists()
{
    return App\Models\Wishlist::where('user_id', auth()->id())->limit(3)->get();
}

function wishlistcheck($product_id)
{
    return App\Models\Wishlist::where('user_id', auth()->id())->where('product_id', $product_id)->exists();
}

function allproduct_thumbnails($single_product_info_id){
    return App\Models\Product_thumbnail::where('product_id', $single_product_info_id)->get();
}

function allwishtocarts()
{
    return App\Models\Cart::where('user_id', auth()->id())->limit(3)->get();
}
function allcarts()
{
    return App\Models\Cart::where('user_id', auth()->id())->get();
}

function cartcount()
{
    return App\Models\Cart::where('user_id', auth()->id())->count();
}

function getvendorname($product_id)
{
    return User::find(Product::find($product_id)->user_id)->name;
}

function available_quantity($product_id)
{
    return Product::find($product_id)->product_quantity;
}


?>
