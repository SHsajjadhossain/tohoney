@extends('layouts.app')

@section('breadcrumb')

<ol class="breadcrumb float-right">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Vendor</li>
</ol>

@endsection

@section('content')

    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Add New Vendor
                </div>
                <div class="card-body">
                    <form action="{{ route('vendor.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Vendor Name</label>
                            <input type="text" class="form-control @error('vendor_name')   is-invalid @enderror" name="vendor_name" placeholder="Enter your name">
                            @error('vendor_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Vendor Email</label>
                            <input type="text" class="form-control @error('vendor_email')   is-invalid @enderror" name="vendor_email" placeholder="Enter your email">
                            @error('vendor_email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Vendor Phone Number</label>
                            <input type="text" class="form-control @error('vendor_phone_number')   is-invalid @enderror" name="vendor_phone_number" placeholder="Enter your phone number">
                            @error('vendor_phone_number')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Vendor Address</label>
                            <input type="text" class="form-control @error('vendor_address')   is-invalid @enderror" name="vendor_address" placeholder="Enter your address">
                            @error('vendor_address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Add New Vendor</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection


