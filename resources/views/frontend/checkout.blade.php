@extends('layouts.app_frontend')

@section('content')
<!-- .breadcumb-area start -->
<div class="breadcumb-area ptb-100" style="background: #fcf6f6;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcumb-wrap text-center">
                    <h2>Checkout</h2>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><span>Checkout</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- .breadcumb-area end -->
<!-- checkout-area start -->
<div class="checkout-area ptb-100">
    <div class="container">
        <form action="{{ route('checkoutpost') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-8">
                    <div class="checkout-form form-style">
                        <h3>Billing Details</h3>
                        <form action="">
                            <div class="row">
                                <div class="col-sm-12 col-12">
                                    <p>Full Name *</p>
                                    <input type="text" name="name" value="{{ auth()->user()->name }}">
                                </div>
                                <div class="col-12">
                                    <p>Email Address *</p>
                                    <input type="text" name="email" value="{{ auth()->user()->email }}">
                                </div>
                                <div class="col-sm-12 col-12">
                                    <p>Phone No. *</p>
                                    <input type="text" name="phone_number" value="{{ auth()->user()->phone_number }}">
                                </div>
                                <div class="col-12">
                                    <label>Country *</label>
                                        <select id="country_dropdown" name="country">
                                            <option value="">Select a country</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    {{-- <p>Country *</p>
                                    <input type="text"> --}}
                                </div>
                                <div class="col-sm-12 col-12">
                                    <label class="city_d">Town/City *</label>
                                        <select id="city_dropdown" name="city">
                                            <option value="1">Select a city</option>
                                            <option value="2">bangladesh</option>
                                            <option value="3">Algeria</option>
                                            <option value="4">Afghanistan</option>
                                            <option value="5">Ghana</option>
                                            <option value="6">Albania</option>
                                            <option value="7">Bahrain</option>
                                            <option value="8">Colombia</option>
                                            <option value="9">Dominican Republic</option>
                                        </select>
                                    {{-- <p>Town/City *</p>
                                    <input type="text"> --}}
                                </div>
                                <div class="col-12">
                                    <p class="c_address">Your Address *</p>
                                    <input type="text" name="address">
                                </div>
                                <div class="col-12 col-sm-12">
                                    <p>Postcode/ZIP</p>
                                    <input type="text" name="postcode">
                                </div>
                                {{-- <div class="col-12">
                                    <input id="toggle1" type="checkbox">
                                    <label for="toggle1">Pure CSS Accordion</label>
                                    <div class="create-account">
                                        <p>Create an account by entering the information below. If you are a returning customer please login at the top of the page.</p>
                                        <span>Account password</span>
                                        <input type="password" name="password">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <input id="toggle2" type="checkbox">
                                    <label class="fontsize" for="toggle2">Ship to a different address?</label>
                                    <div class="row" id="open2">
                                        <div class="col-12">
                                            <label>Country</label>
                                            <select id="s_country">
                                                <option value="1">Select a country</option>
                                                <option value="2">bangladesh</option>
                                                <option value="3">Algeria</option>
                                                <option value="4">Afghanistan</option>
                                                <option value="5">Ghana</option>
                                                <option value="6">Albania</option>
                                                <option value="7">Bahrain</option>
                                                <option value="8">Colombia</option>
                                                <option value="9">Dominican Republic</option>
                                            </select>
                                        </div>
                                        <div class=" col-12">
                                            <p>First Name</p>
                                            <input id="s_f_name" type="text" />
                                        </div>
                                        <div class=" col-12">
                                            <p>Last Name</p>
                                            <input id="s_l_name" type="text" />
                                        </div>
                                        <div class="col-12">
                                            <p>Company Name</p>
                                            <input id="s_c_name" type="text" />
                                        </div>
                                        <div class="col-12">
                                            <p>Address</p>
                                            <input type="text" placeholder="Street address" />
                                        </div>
                                        <div class="col-12">
                                            <input type="text" placeholder="Apartment, suite, unit etc. (optional)" />
                                        </div>
                                        <div class="col-12">
                                            <p>Town / City </p>
                                            <input id="s_city" type="text" placeholder="Town / City" />
                                        </div>
                                        <div class="col-12">
                                            <p>State / County </p>
                                            <input id="s_county" type="text" />
                                        </div>
                                        <div class="col-12">
                                            <p>Postcode / Zip </p>
                                            <input id="s_zip" type="text" placeholder="Postcode / Zip" />
                                        </div>
                                        <div class="col-12">
                                            <p>Email Address </p>
                                            <input id="s_email" type="email" />
                                        </div>
                                        <div class="col-12">
                                            <p>Phone </p>
                                            <input id="s_phone" type="text" placeholder="Phone Number" />
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="col-12">
                                    <p>Order Notes </p>
                                    <textarea name="order_notes" placeholder="Notes about Your Order, e.g.Special Note for Delivery"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="order-area">
                        <h3>Your Order</h3>
                        <ul class="total-cost">
                            @forelse (allcarts() as $cart)
                                <li>{{ $cart->relationtoproduct->product_name }} x {{ $cart->amount }} <span class="pull-right">${{ $cart->amount*$cart->relationtoproduct->product_price }}</span></li>
                            @empty
                            <li class="text-danger">No Product To Show</li>
                            @endforelse
                            <li>Cart total <span class="pull-right"><strong>${{ Session::get('s_cart_total') }}</strong></span></li>
                            <li>Discount total <span class="pull-right"><strong>${{ Session::get('s_discount_total') }}</strong></span></li>
                            <li>Subtotal <span class="pull-right"><strong>${{ $sub_total = round(Session::get('s_cart_total') - Session::get('s_discount_total')) }}</strong></span></li>
                            <li>Shipping <span class="pull-right">$0</span></li>
                            {{-- {{  $total_shipping = Session::get('s_total_shipping') }} --}}
                            <li>Grand Total<span class="pull-right">${{ $sub_total }}</span></li>
                        </ul>
                        <ul class="payment-method">
                            <li>
                                <input id="bank" type="checkbox">
                                <label for="bank">Direct Bank Transfer</label>
                            </li>
                            <li>
                                <input id="paypal" type="checkbox">
                                <label for="paypal">Paypal</label>
                            </li>
                            <li>
                                <input id="card" type="checkbox">
                                <label for="card">Credit Card</label>
                            </li>
                            <li>
                                <input id="delivery" type="checkbox">
                                <label for="delivery">Cash on Delivery</label>
                            </li>
                        </ul>
                        <button type="submit">Place Order</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- checkout-area end -->
@endsection

@section('footer_scripts')

<script>
    $(document).ready(function() {
    $('#country_dropdown').select2();
});

    $(document).ready(function() {
    $('#city_dropdown').select2();
});
</script>

@endsection
