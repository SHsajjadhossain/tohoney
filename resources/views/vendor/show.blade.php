@extends('layouts.app')

@section('breadcrumb')

<ol class="breadcrumb float-right">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('vendor.index') }}">List Vendor</a></li>
    <li class="breadcrumb-item active">Vendor Details</li>
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
                        <tbody>
                                <tr>
                                    <td>Vendor Name</td>
                                    <td>{{ $single_vendor->relationTouser->name }}</td>
                                </tr>
                                <tr>
                                    <td>Vendor Photo</td>
                                    <td>
                                        <img style="width: 100px" src="{{ asset('uploads/profile_photoes/'.$single_vendor->relationTouser->profile_photo )}}" alt="Not Found">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Vendor Email</td>
                                    <td>{{ $single_vendor->relationTouser->email }}</td>
                                </tr>
                                <tr>
                                    <td>Vendor Phone Number</td>
                                    <td>{{ $single_vendor->relationTouser->phone_number }}</td>
                                </tr>
                                <tr>
                                    <td>Vendor Address</td>
                                    <td>{{ $single_vendor->address }}</td>
                                </tr>
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
