@extends('layouts.app')

@section('breadcrumb')

<ol class="breadcrumb float-right">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">All Orders</li>
</ol>

@endsection

@section('content')

<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                My Orders
            </div>
            <div class="card-body">
                <table class="table table-inverse table-bordered">
                    <thead class="thead-inverse">
                        <tr>
                            <th>Order ID</th>
                            <th>Grand Total</th>
                            <th>Payment Option</th>
                            <th>Payment Status</th>
                            <th>Recieved Status</th>
                            <th>QR Code</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse ($order_summeries as $order_summery)
                                <tr>
                                    <td>{{ $order_summery->id }}</td>
                                    <td>{{ $order_summery->grand_total }}</td>
                                    <td>
                                        @if ($order_summery->payment_option == 1)
                                            <span>Cash On Delivery</span>
                                        @else
                                            <span>Online Payment</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($order_summery->payment_status == 0)
                                            <span class="badge badge-danger">Not Paid Yet</span>
                                        @else
                                            <span class="badge badge-success">Paid</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($order_summery->delivered_status == 0)
                                            <span class="badge badge-warning">Pending</span>
                                        @else
                                            <span class="badge badge-primary">Delivered</span>
                                        @endif
                                    </td>
                                    <td>
                                        {!! DNS2D::getBarcodeHTML("$order_summery->id", 'QRCODE', 3,3); !!}
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-success" href="{{ route('order.details', Crypt::encryptString($order_summery->id)) }}">Details</a>
                                        @if ($order_summery->payment_status == 1 && $order_summery->delivered_status == 0)
                                        <a class="btn btn-sm btn-info" href="{{ route('mark.as.recieved', $order_summery->id) }}">Mark as Recieved</a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <span class="text-danger">No Order To Show</span>
                            @endforelse
                        </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer_scripts')



@endsection




