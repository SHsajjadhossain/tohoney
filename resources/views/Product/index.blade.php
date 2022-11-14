@extends('layouts.app')

@section('breadcrumb')

<ol class="breadcrumb float-right">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Product</li>
    <li class="breadcrumb-item active">List Product</li>
</ol>

@endsection

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            @if (auth()->user()->role == 3)
                <div class="card-header">
                    Product List
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>SL. No</th>
                                <th>Product Name</th>
                                <th>Category Name</th>
                                <th>Product Price</th>
                                <th>Product Photo</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <tr>
                                    <td>{{ $loop->index +1}}</td>
                                    <td>{{ $product->product_name }}</td>
                                    <td>{{ $product->category_id }}</td>
                                    <td>{{ $product->product_price }}</td>
                                    <td>
                                        <img style="width: 100px;" src="{{ asset('uploads/product_photoes') }}/{{ $product->product_photo }}" alt="">
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-info" href="#">Edit</a>
                                        <a class="btn btn-sm btn-success" href="#">Details</a>
                                        <a class="btn btn-sm btn-danger" href="#">Delete</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="50" class="text-center alert alert-danger">
                                        <span class="text-danger">No Prduct available</span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            @else
            <div class="alert alert-danger">
                You are not allowed to view this page
            </div>
            @endif

        </div>
    </div>
</div>

@endsection
