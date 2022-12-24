@extends('layouts.app')

@section('breadcrumb')

<ol class="breadcrumb float-right">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('my.orders') }}">My Orders</a></li>
    <li class="breadcrumb-item active">My Order Details</li>
</ol>

@endsection

@section('content')

<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                My Order Details
            </div>
            <div class="card-body">
                <table class="table table-bordered table-inverse">
                        <tbody>
                            <tr>
                                <td>User Name</td>
                                <td>{{ $order_summeries->relationtouser->name }}</td>
                            </tr>
                            <tr>
                                <td>Coupon Name</td>
                                <td>{{ ($order_summeries->coupon_name) ? $order_summeries->coupon_name : 'N/A'  }}</td>
                            </tr>
                            <tr>
                                <td>Cart Total</td>
                                <td>{{ $order_summeries->cart_total }}</td>
                            </tr>
                            <tr>
                                <td>Discount Total</td>
                                <td>{{ $order_summeries->discount_total }}</td>
                            </tr>
                            <tr>
                                <td>Sub Total</td>
                                <td>{{ $order_summeries->sub_total }}</td>
                            </tr>
                            <tr>
                                <td>Grand Total</td>
                                <td>{{ $order_summeries->grand_total }}</td>
                            </tr>
                            <tr>
                                <td>Shipping</td>
                                <td>{{ $order_summeries->shipping }}</td>
                            </tr>
                            <tr>
                                <td>Payment Option</td>
                                <td>
                                    @if ($order_summeries->payment_option == 1)
                                        <span>Cash On Delivery</span>
                                    @else
                                        <span>Online Payment</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Payment Status</td>
                                <td>
                                    @if ($order_summeries->payment_status == 1)
                                        <span class="badge badge-success">Paid</span>
                                    @else
                                        <span class="badge badge-danger">Not Paid Yet</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Created_at</td>
                                <td>{{ $order_summeries->created_at->format('d M Y, h:i A') }}</td>

                                {{-- This is another way to write date-time format --}}
                                {{-- <td>{{ $order_summeries->created_at->format('d M Y, g:i') }}</td> --}}
                            </tr>
                        </tbody>
                </table>
            </div>
            <div class="card-footer">
                @foreach ($order_details as $order_detail)
                    <div class="card mb-2">
                        <div class="card-body">
                            <table class="table table-bordered table-inverse">
                                <tbody>
                                    <tr>
                                        <td>Vendor Name</td>
                                        <td>{{ $order_detail->relationtouser->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Product Name</td>
                                        <td>{{ $order_detail->relationtoproduct->product_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Product Photo</td>
                                        <td>
                                            <img style="width: 200px; height: 200px" src="{{ asset('uploads/product_photoes') }}/{{ $order_detail->relationtoproduct->product_photo }}" alt="Not Found">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Amount</td>
                                        <td>{{ $order_detail->amount }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer_scripts')



@endsection




