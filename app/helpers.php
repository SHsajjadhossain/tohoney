<?php

function allwishlists()
{
    return App\Models\Wishlist::where('user_id', auth()->id())->limit(3)->get();
}

function allproduct_thumbnails($single_product_info_id){
    return App\Models\Product_thumbnail::where('product_id', $single_product_info_id)->get();
}

function allcarts()
{
    return App\Models\Cart::where('user_id', auth()->id())->limit(3)->get();
}

function cartcount()
{
    return App\Models\Cart::where('user_id', auth()->id())->count();
}

?>
