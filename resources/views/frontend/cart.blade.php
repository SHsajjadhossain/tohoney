@extends('layouts.app_frontend')

@section('content')

<!-- .breadcumb-area start -->
<div class="breadcumb-area ptb-100" style="background: #fcf6f6;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcumb-wrap text-center">
                    <h2>Shopping Cart</h2>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><span>Shopping Cart</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- .breadcumb-area end -->
<!-- cart-area start -->
<div class="cart-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                    <table class="table-responsive cart-wrap">
                        <thead>
                            <tr>
                                <th class="images">Image</th>
                                <th class="product">Product</th>
                                <th class="product">Vendor Name</th>
                                <th class="ptice">Price</th>
                                <th class="quantity">Quantity</th>
                                <th class="total">Total</th>
                                <th class="status">Status</th>
                                <th class="remove">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            <form action="{{ route('cartupdate') }}" method="POST">
                                @csrf
                            @php
                                $cart_total = 0;
                                $flag = false;
                            @endphp
                            @forelse (allcarts() as $cart)
                                <tr>
                                    <td class="images"><img src="{{ asset('uploads/product_photoes') }}/{{ $cart->relationtoproduct->product_photo }}" alt="Not Found"></td>
                                    <td class="product"><a href="single-product.html">{{ $cart->relationtoproduct->product_name }}</a></td>
                                    <td class="product"><a> {{ getvendorname($cart->product_id) }} </a></td>
                                    <td class="ptice">${{ $cart->relationtoproduct->product_price }}</td>
                                    <td class="quantity cart-plus-minus">
                                        <input type="text" name="qybutton[{{ $cart->id }}]" value="{{ $cart->amount }}" />
                                    </td>
                                    <td class="total">
                                        ${{ $cart->amount * $cart->relationtoproduct->product_price }}
                                        @php
                                            $cart_total += $cart->amount * $cart->relationtoproduct->product_price;
                                        @endphp
                                    </td>
                                    <td class="status">
                                        @if ($cart->amount > $cart->relationtoproduct->product_quantity)
                                                <span class="text-danger">Stockout</span>
                                        @php
                                            $flag= true;
                                        @endphp
                                        @else
                                            <span>Available</span>
                                        @endif
                                        {{-- @if ($cart->amount > available_quantity($cart->product_id) )
                                            <span class="text-danger">Stockout</span>
                                        @else
                                            <span>Available</span>
                                        @endif --}}
                                    </td>
                                    <td class="remove">
                                        <a href="{{ route('cart.remove', $cart->id) }}"><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-danger text-center" colspan="50">
                                        <p>No Product To Show</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="row mt-60">
                        <div class="col-xl-4 col-lg-6 col-md-6 ">
                            <div class="cartcupon-wrap">
                                <ul class="d-flex">
                                    <li>
                                        <button type="submit">Update Cart</button>
                                        </form>
                                    </li>
                                    <li><a href="{{ route('shoppage') }}">Continue Shopping</a></li>
                                    {{-- <li><a href="shop.html">Clear Shopping Cart</a></li> --}}
                                </ul>

                                <h3>Cupon</h3>
                                <p>Enter Your Cupon Code if You Have One</p>
                                <div class="cupon-wrap">
                                    <form>
                                        <input type="text" name="coupon_name" value="{{ ($coupon_name) ? $coupon_name:'' }}" placeholder="Cupon Code">
                                        <button type="submit">Apply Cupon</button>
                                    </form>
                                    @if (session('coupon_err'))
                                    <div class="alert alert-danger mt-2">
                                        {{ session('coupon_err') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 offset-xl-5 col-lg-6 offset-lg-3 col-md-6">
                            <div class="cart-total text-right">
                            @auth
                            <a href="{{ route('clearcart', auth()->id()) }}" class="clear-cart">Clear Shopping Cart</a>
                            @endauth
                                <h3>Cart Totals</h3>
                                <ul>
                                    @php
                                        Session::put('s_cart_total', $cart_total);
                                        Session::put('s_discount_total', $discount_total);
                                    @endphp
                                    <li><span class="pull-left">Cart total </span>${{ $cart_total }}</li>
                                    <li><span class="pull-left">Discount total({{ ($coupon_name) ? $coupon_name:'N/A' }}) </span>${{ $discount_total }}</li>
                                    <li><span class="pull-left s-total">Sub Total(approx.) </span><span>$</span><span id="sub_total">{{ round($cart_total-$discount_total) }}</span></li>
                                    <li><span class="pull-left" style="margin-top: 15px">Total Shipping </span></li>
                                    <li class="shipping-check">
                                        <input id="shipping_btn_1" class="shipping_btn_value1" type="radio" name="shipping">
                                        Standard
                                        <span>$20</span>
                                    </li>
                                    <li class="shipping-check">
                                        <input id="shipping_btn_2" class="shipping_btn_value2" type="radio" name="shipping">
                                        Express
                                        <span>$30</span>
                                    </li>
                                    <li class="shipping-check">
                                        <input id="shipping_btn_3" class="shipping_btn_value3" type="radio" name="shipping">
                                        Free
                                        <span>$0</span>
                                    </li>
                                    <li style="margin-top: 25px"><span class="pull-left"> Grand Total </span> <span>$</span><span id="grand_total">{{ round($cart_total-$discount_total) }}</span></li>
                                </ul>

                                @if ($flag)
                                <div class="alert alert-danger">
                                    <span>Please remove the stockout product first</span>
                                </div>
                                @else
                                <a id="checkout_btn" class="d-none" href="{{ route('checkout') }}">Proceed to Checkout</a>
                                @endif
                            </div>
                        </div>
                    </div>

            </div>
        </div>
    </div>
</div>
<!-- cart-area end -->

@endsection

@section('footer_scripts')
{{-- @php
    Session::put('s_total_shipping', 0);
@endphp --}}
<script>
    $('#shipping_btn_1').click(function(){
        $('#grand_total').html(parseInt($('#sub_total').html())+20);
        $('#checkout_btn').removeClass('d-none');
    });
    $('#shipping_btn_2').click(function(){
        $('#grand_total').html(parseInt($('#sub_total').html())+30);
        $('#checkout_btn').removeClass('d-none');
    });
    $('#shipping_btn_3').click(function(){
        $('#grand_total').html(parseInt($('#sub_total').html())+0);
        $('#checkout_btn').removeClass('d-none');
    });
</script>
@endsection
