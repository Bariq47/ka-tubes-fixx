@extends('layouts.app')
@section('content')
<style>
    body {
        background-color: #F4CDB0;
    }
    .btn-custom {
        background-color: #644961;
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
    }
    .btn-custom1 {
        background-color: #F4CDB0;
        border: none;
        color: #644961;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
    }
</style>
<div class="container-sm mt-5">
    <div class="row justify-content-center">
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="row justify-content-center">
                <div class="p-5 bg-light rounded-3 border col-xl-6">
                    <div class="mb-3 text-center fw-bold display-2" style="color: #644961">
                        <h2>Add Category</h2>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="code" class="form-label fw-bold" style="color: #644961">Category Code</label>
                            <input class="form-control @error('code') is-invalid @enderror" type="text" name="code"
                                id="code" value="{{ old('code') }}" placeholder="Enter Category Code">
                            @error('code')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label fw-bold" style="color: #644961">Category Name</label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name"
                                id="name" value="{{ old('name') }}" placeholder="Enter Category Name">
                            @error('name')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="description" class="form-label fw-bold" style="color: #644961">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description"
                                id="description" placeholder="Enter Category Description">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6 d-grid">
                            <a href="{{ route('home') }}" class="btn btn-custom1 mt-3 fw-semibold">Cancel</a>
                        </div>
                        <div class="col-md-6 d-grid">
                            <button type="submit" class="btn btn-custom mt-3 fw-semibold">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
