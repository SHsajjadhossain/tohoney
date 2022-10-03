@extends('layouts.app')

@section('breadcrumb')

<ol class="breadcrumb float-right">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Profile</li>
</ol>

@endsection

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                @if (auth()->user()->role == 2)
                    <div class="card-header">
                        Customer List
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Check</th>
                                    <th>SL. No</th>
                                    <th>Customer Name</th>
                                    <th>Customer Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <form action="{{ route('checkmail') }}" method="POST">
                                    @csrf
                                @foreach ($customers as $customer)
                                    <tr>
                                        <td class="text-center">
                                            <input type="checkbox" name="check[]" value="{{ $customer->id }}">
                                        </td>
                                        <td>{{ $loop->index +1 }}</td>
                                        <td>{{ $customer->name }}</td>
                                        <td>{{ $customer->email }}</td>
                                        <td>
                                            <a href="{{ route('sendmail', $customer->id) }}" class="btn btn-success ">Send</a>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-info">Send Check</button>
                                    </td>
                                </tr>
                                </form>
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

