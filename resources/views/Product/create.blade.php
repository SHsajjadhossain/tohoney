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
                Add New Product
            </div>
            <div class="card-body">
                <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Category Name</label>
                        <select name="category_id" class="form-control">
                            <option value="">--Select One--</option>
                            @foreach ($active_categories as $active_category)
                            <option value="{{ $active_category->id }}">{{ $active_category->category_name }}</option>
                            @endforeach
                        </select>
                        @error('product_category')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Product Name</label>
                        <input type="text" class="form-control @error('product_name')   is-invalid @enderror"
                            name="product_name" placeholder="Enter product name">
                        @error('product_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Product Price</label>
                        <input type="number" class="form-control @error('product_price')   is-invalid @enderror"
                            name="product_price" placeholder="Enter product price">
                        @error('product_price')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Product Short Descripton</label>
                        <textarea name="product_short_description"
                            class="form-control  @error('product_short_description')   is-invalid @enderror" rows="2"
                            placeholder="Enter product short description"></textarea>
                        @error('product_short_description')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Product Code</label>
                        <input type="text" class="form-control @error('product_code')   is-invalid @enderror"
                            name="product_code" placeholder="Enter product code">
                        @error('product_code')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Product Quantity</label>
                        <input type="number" class="form-control @error('product_quantity')   is-invalid @enderror"
                            name="product_quantity" placeholder="Enter product quantity">
                        @error('product_code')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Product Long Descripton</label>
                        <textarea name="product_long_description"
                            class="form-control  @error('product_long_description')   is-invalid @enderror" rows="4"
                            placeholder="Enter product long description"></textarea>
                        @error('product_long_description')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Product Photo</label>
                        <input type="file" class="form-control @error('product_photo')   is-invalid @enderror"
                            name="product_photo">
                        @error('product_photo')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Product Thumbnails</label>
                        <input type="file" class="form-control @error('product_thumbnails')   is-invalid @enderror"
                            name="product_thumbnails[]" multiple>
                        @error('product_thumbnails')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Add New Product</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
