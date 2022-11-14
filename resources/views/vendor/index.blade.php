@extends('layouts.app')

@section('breadcrumb')

<ol class="breadcrumb float-right">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Vendor</li>
    <li class="breadcrumb-item active">List Vendor</li>
</ol>

@endsection

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            @if (auth()->user()->role == 2)
                <div class="card-header">
                    Vendor List
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>SL. No</th>
                                <th>Vendor Name</th>
                                <th>Vendor Photo</th>
                                <th>Vendor Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($allvendors as $vendor)
                                <tr>
                                    <td>{{ $loop->index +1 }}</td>
                                    <td>{{ $vendor->relationTouser->name }}</td>
                                    <td>{{ $vendor->relationTouser->profile_photo }}</td>
                                    <td>{{ $vendor->relationTouser->email }}</td>
                                    <td>
                                        <a class="btn btn-success btn-sm" href="{{ route('vendor.show', $vendor->id) }}">Details</a>
                                    </td>
                                </tr>
                            @empty
                            <tr>
                                <td colspan="50" class="text-center alert alert-danger">
                                    <span class="text-danger">No Vendor available</span>
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
</h1>
