@extends('layouts.app')

@section('breadcrumb')

<ol class="breadcrumb float-right">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">My Orders</li>
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
                <table class="table table-striped table-inverse table-bordered">
                    <thead class="thead-inverse">
                        <tr>
                            <th>Order ID</th>
                            <th>Grand Total</th>
                            <th>Payment Option</th>
                            <th>Payment Status</th>
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
                                            Cash On Delivery
                                        @else
                                            Online Payment
                                        @endif
                                    </td>
                                    <td>
                                        @if ($order_summery->payment_status == 0)
                                            Not Paid Yet
                                        @else
                                            Paid
                                        @endif
                                    </td>
                                    <td>
                                        {!! DNS2D::getBarcodeHTML("$order_summery->id", 'QRCODE', 3,3); !!}
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-success" href="">Details</a>
                                        <a class="btn btn-sm btn-info" href="{{ route('invoice.download') }}">Invoice Download PDF</a>
                                        <a class="btn btn-sm btn-warning" href="{{ route('invoice.download.excel') }}">Invoice Download Excel</a>
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



