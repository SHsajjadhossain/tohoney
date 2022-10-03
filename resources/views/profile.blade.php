@extends('layouts.app')

@section('breadcrumb')

<ol class="breadcrumb float-right">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Profile</li>
</ol>

@endsection

@section('content')

    <div class="row justify-content-center">
            <div class="col-12">
                <div class="alert alert-secondary ">
                    Account Created : {{ Auth::user()->created_at->diffForHumans() }}
                </div>
            </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    Change Name
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form action="{{ route('profile.namechange') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control mt-1 @error('name') is-invalid @enderror" name="name" value="{{ Auth::user()->name }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <button class="btn btn-success btn-sm">Change Name</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    Change Profile Photo
                </div>
                <div class="card-body">
                    @if (session('success_photo'))
                        <div class="alert alert-success">
                            {{ session('success_photo') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-12 text-center">
                            <img src="{{ asset('uploads/profile_photoes').'/'.Auth::user()->profile_photo }}" style="width: 270px" class="card-img-top" alt="...">
                        </div>
                    </div>

                    <form action="{{ route('profile.photochange') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>New Photo</label>
                            <input type="file" class="form-control mt-1 @error('profile_photo')  is-invalid @enderror" name="profile_photo" accept=".jpg, .jpeg, .png, .svg, .webp">
                            @error('profile_photo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <button class="btn btn-success btn-sm">Change Your Photo</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    Change Password
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li class="text-danger">{{ $error }}</li>
                            @endforeach
                        </div>
                    @endif
                    @if (session('success_pass'))
                        <div class="alert alert-success">
                            {{ session('success_pass') }}
                        </div>
                    @endif
                    <form action="{{ route('passwordchange') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Old Password</label>
                            <input type="password" class="form-control mt-1" name="old_password">
                        </div>
                        <div class="form-group mt-3">
                            <label>New Password</label>
                            <input type="password" class="form-control mt-1" name="password">
                        </div>
                        <div class="form-group mt-3">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control mt-1" name="confirm_password">
                        </div>
                        <div class="form-group mt-3">
                            <button class="btn btn-success btn-sm">Change Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
