@extends('layouts.app')

@section('breadcrumb')

<ol class="breadcrumb float-right">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Coupon</li>
</ol>

@endsection

@section('content')

    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Add Coupon
                </div>
                <div class="card-body">
                    <form action="{{ route('coupon.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Coupon Name</label>
                            <input type="text" class="form-control @error('coupon_name')   is-invalid @enderror" name="coupon_name" placeholder="Enter Coupon Name">
                            @error('coupon_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Coupon Discount Percentage</label>
                            <input type="text" class="form-control @error('discount_percentage')   is-invalid @enderror" name="discount_percentage" placeholder="Enter Discount Percentage">
                            @error('discount_percentage')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Coupon Validity</label>
                            <input type="date" class="form-control @error('validity')   is-invalid @enderror" name="validity">
                            @error('validity')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Coupon Limit</label>
                            <input type="number" class="form-control @error('limit')   is-invalid @enderror" name="limit" placeholder="Enter Coupon Limit">
                            @error('limit')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Add New Coupon</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection


