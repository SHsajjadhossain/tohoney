@extends('layouts.app')

@section('breadcrumb')

<ol class="breadcrumb float-right">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Location</li>
</ol>

@endsection

@section('content')

<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                Add Location
            </div>
            <div class="card-body">
                <form action="{{ route('location.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Select a country</label>
                        <select id="countries_dropdown" class="form-control" name="countries[]" multiple="multiple">
                            <option value="">Select a country</option>
                            @foreach ($countries as $country)
                                <option {{ ($country->status == 'active') ? 'selected' : '' }} value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Location</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer_scripts')

<script>
    $(document).ready(function() {
    $('#countries_dropdown').select2();
});
</script>

@endsection


