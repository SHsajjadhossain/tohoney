<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function wishtocart($wishlist_id)
    {
        $vendor_id = Product::find(Wishlist::find($wishlist_id)->product_id)->user_id;
        if (Cart::where('user_id', auth()->id())->where('product_id', Wishlist::find($wishlist_id)->product_id)->exists()) {
            Cart::where('user_id', auth()->id())->where('product_id', Wishlist::find($wishlist_id)->product_id)->increment('amount', 1);
        }
        else {
            Cart::insert([
                'user_id' => auth()->id(),
                'vendor_id' => $vendor_id,
                'product_id' => Wishlist::find($wishlist_id)->product_id,
                'created_at' => Carbon::now(),
            ]);
        }
        Wishlist::find($wishlist_id)->delete();
        return back();
    }
    public function addtocart(Request $request, $product_id)
    {
        if (Product::find($product_id)->product_quantity < $request->qybutton) {
            return back()->with('stockout', 'Out Of Stock');
        }
        else{

            if (Cart::where('user_id', auth()->id())->where('product_id', $product_id)->exists()) {
                if (Product::find($product_id)->product_quantity < (Cart::where('user_id', auth()->id())->where('product_id', $product_id)->first()->amount + $request->qybutton)) {
                    return back()->with('stockout', 'Already Have In The Cart');
                }
                else {
                    Cart::where('user_id', auth()->id())->where('product_id', $product_id)->increment('amount', $request->qybutton);
                }
            }
            else {
                Cart::insert([
                    'user_id' => auth()->id(),
                    'vendor_id' => Product::find($product_id)->user_id,
                    'product_id' => $product_id,
                    'amount' => $request->qybutton,
                    'created_at' => Carbon::now(),
                ]);
            }
        }
        return back();
    }

    public function cart()
    {
        if (isset($_GET['coupon_name'])) {
            if ($_GET['coupon_name']) {
                $coupon_name = $_GET['coupon_name'];
                if (Coupon::where('coupon_name', $coupon_name)->exists()) {
                    $coupon_info = Coupon::where('coupon_name', $coupon_name)->first();
                    if ($coupon_info->limit != 0 ) {
                        if ($coupon_info->validity < Carbon::today()->format('Y-m-d')) {
                            $discount_total = 0;
                            return redirect('cart')->with('coupon_err', $coupon_name . ' coupon date over');
                        }
                        else {
                            $discount_total = (session('s_cart_total') * $coupon_info->discount_percentage)/100;
                        }
                    }
                    else {
                        $discount_total = 0;
                        return redirect('cart')->with('coupon_err', $coupon_name . ' limit is over');
                    }
                }
                else{
                    $discount_total = 0;
                    return redirect('cart')->with('coupon_err', $coupon_name.' is an invalid coupon');
                }
            }
            else {
                $coupon_name = '';
                $discount_total = 0;
            }
        }
        else {
            $coupon_name = '';
            $discount_total = 0;
        }
        return view('frontend.cart', compact('discount_total', 'coupon_name'));
    }

    public function remove($cart_id)
    {
        Cart::find($cart_id)->delete();
        return back();
    }

    public function clearcart($user_id)
    {
        Cart::where('user_id', $user_id)->delete();
        return back();
    }

    public function cartupdate(Request $request)
    {
        foreach ($request->qybutton as $cart_id => $updated_amount) {
            Cart::find($cart_id)->update([
                'amount' => $updated_amount,
            ]);
        }
        return back();
    }
}
