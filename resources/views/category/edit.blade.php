@extends('layouts.app')

@section('breadcrumb')

<ol class="breadcrumb float-right">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Category</li>
</ol>

@endsection

@section('content')

    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Edit Category - {{ $category->category_name }}
                </div>
                <div class="card-body">
                    <form action="{{ route('category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label>Category Status</label>
                            <select name="status" class="form-control">
                                <option value="show"{{ ($category->status == "show")? 'selected': '' }}>Show</option>
                                <option value="hide"{{ ($category->status == "hide")? 'selected': '' }}>Hide</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Category Name</label>
                            <input type="text" class="form-control @error('category_name')   is-invalid @enderror" name="category_name" value="{{ $category->category_name }}" placeholder="Enter Category Name">
                            @error('category_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Old Category Photo</label>
                            <br>
                            <img width="200" src="{{ asset('uploads/category_photoes').'/'.$category->category_photo }}" alt="">
                        </div>
                        <div class="form-group">
                            <label>New Category Photo</label>
                            <input type="file" class="form-control @error('category_photo')   is-invalid @enderror" name="new_category_photo">
                            @error('category_photo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Edit Category</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

