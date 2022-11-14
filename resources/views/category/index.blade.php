@extends('layouts.app')

@section('breadcrumb')

<ol class="breadcrumb float-right">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Category</li>
    <li class="breadcrumb-item active">List Category</li>
</ol>

@endsection

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            @if (auth()->user()->role == 2)
                <div class="card-header">
                    Category List
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>SL. No</th>
                                <th>Category Name</th>
                                <th>Category Photo</th>
                                <th>Category Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                                @forelse ($categories as $category)
                                <tr>
                                    <td>{{ $loop->index +1 }}</td>
                                    <td>{{ $category->category_name }}</td>
                                    <td>
                                        <img width="150" src="{{ asset('uploads/category_photoes').'/'.$category->category_photo }}" alt="Not Found">
                                    </td>
                                    <td>
                                        @if ($category->status == "show")
                                            <span class="badge badge-success" style="width: 70px; padding: 10px">Show</span>
                                        @else
                                            <span class="badge badge-danger" style="width: 70px; padding: 10px">Hide</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('category.edit', $category->id) }}" class="btn btn-info btn-sm">Edit</a>
                                        <form style="display: inline;" action="{{ route('category.destroy', $category->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="50" class="text-center alert alert-danger">
                                        <span class="text-danger">No Category available</span>
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
