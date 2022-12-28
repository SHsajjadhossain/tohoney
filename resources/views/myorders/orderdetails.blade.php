@extends('layouts.app')

@section('breadcrumb')

<ol class="breadcrumb float-right">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('my.orders') }}">My Orders</a></li>
    <li class="breadcrumb-item active">My Order Details</li>
</ol>

@endsection

@section('content')

<style>
.rate {
float: left;
height: 46px;
padding: 0 0px;
margin-top: -15px
}
.rate:not(:checked) > input {
position:absolute;
top: 0px;
opacity: 0;
}
.rate:not(:checked) > label {
float:right;
width:1em;
overflow:hidden;
white-space:nowrap;
cursor:pointer;
font-size:30px;
color:#ccc;
}
.rate:not(:checked) > label:before {
content: '★ ';
}
.rate > input:checked ~ label {
color: #ffc700;
}
.rate:not(:checked) > label:hover,
.rate:not(:checked) > label:hover ~ label {
color: #deb217;
}
.rate > input:checked + label:hover,
.rate > input:checked + label:hover ~ label,
.rate > input:checked ~ label:hover,
.rate > input:checked ~ label:hover ~ label,
.rate > label:hover ~ input:checked ~ label {
color: #c59b08;
}
</style>

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
                            <tr>
                                <td>Delivered Status</td>
                                <td>
                                    @if ($order_summeries->delivered_status == 0)
                                        <span class="badge badge-warning">Pending</span>
                                    @else
                                        <span class="badge badge-primary">Delivered</span>
                                    @endif
                                </td>
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
                            <div class="row">
                                <div class="col-12">
                                    @if ($order_summeries->delivered_status == 1)
                                        <form action="{{ route('rating', $order_detail->id) }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label>Your Review</label>
                                                <textarea class="form-control" name="reivew" id="" rows="4" style="resize: none"></textarea>
                                            </div>
                                            <p><span>Your Rating</span></p>
                                                <div class="form-group">
                                                    <div class="rate">
                                                        <input type="radio" id="star5_{{ $order_detail->id }}" name="rate" value="5" />
                                                        <label for="star5_{{ $order_detail->id }}" title="text">5 stars</label>
                                                        <input type="radio" id="star4_{{ $order_detail->id }}" name="rate" value="4" />
                                                        <label for="star4_{{ $order_detail->id }}" title="text">4 stars</label>
                                                        <input type="radio" id="star3_{{ $order_detail->id }}" name="rate" value="3" />
                                                        <label for="star3_{{ $order_detail->id }}" title="text">3 stars</label>
                                                        <input type="radio" id="star2_{{ $order_detail->id }}" name="rate" value="2" />
                                                        <label for="star2_{{ $order_detail->id }}" title="text">2 stars</label>
                                                        <input type="radio" id="star1_{{ $order_detail->id }}" name="rate" value="1" />
                                                        <label for="star1_{{ $order_detail->id }}" title="text">1 star</label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button class="btn btn-success" style="margin-top: -10px; margin-left: 10px">Submit</button>
                                                </div>
                                        </form>
                                    @endif
                                </div>
                            </div>
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




