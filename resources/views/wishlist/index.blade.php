@extends('layouts.app_frontend')

@section('content')
 <!-- .breadcumb-area start -->
    <div class="breadcumb-area ptb-100" style="background: #fcf6f6;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Wishlist</h2>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><span>Wishlist</span></li>
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
                    <form action="">
                        <table class="table-responsive cart-wrap">
                            <thead>
                                <tr>
                                    <th class="images">Image</th>
                                    <th class="product">Product</th>
                                    <th class="ptice">Price</th>
                                    <th class="stock">Stock Stutus </th>
                                    <th class="addcart">Add to Cart</th>
                                    <th class="remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($wishlists as $wishlist )
                                    <tr>
                                        <td class="images"><img src="{{ asset('uploads/product_photoes') }}/{{ $wishlist->relationtoproduct->product_photo }}" alt=""></td>
                                        <td class="product"><a>{{ $wishlist->relationtoproduct->product_name }}</a></td>
                                        <td class="ptice">${{ $wishlist->relationtoproduct->product_price }}</td>
                                        <td class="stock">In Stock</td>
                                        <td class="addcart"><a href="{{ route('wishtocart', $wishlist->id) }}">Add to Cart</a></td>
                                        <td class="remove"><a href="{{ route('wishlist.remove', $wishlist->id) }}"><i class="fa fa-times"></i></a></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="50">
                                            <span class="text-danger">No Product To Show</span>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- cart-area end -->
@endsection
