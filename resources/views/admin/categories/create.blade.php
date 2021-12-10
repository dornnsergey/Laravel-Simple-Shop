@extends('layouts.app')

@section('content')
    <h1>Add category</h1>
    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="input-group row mb-2">
            <label class="form-label col-sm-2" for="code">Code</label>
            <div class="col-sm-6">
                <input class="form-control @error('code') is-invalid @enderror" name="code" id="code" value="{{ old('code') }}">
                @error('code')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="input-group row mb-2">
            <label class="form-label col-sm-2" for="name">Name</label>
            <div class="col-sm-6">
                <input class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') }}">
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="input-group row mb-2">
            <label class="form-label col-sm-2" for="description">Description</label>
            <div class="col-sm-6">
                <textarea class="form-control @error('description') is-invalid @enderror" rows="8" name="description"
                          id="description">{{ old('description') }}</textarea>
                @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="input-group row mb-2">
            <label class="form-label col-sm-2" for="image">Image</label>
            <div class="col-sm-6">
                <input class="form-control @error('image') is-invalid @enderror" type="file" name="image" id="image">
                @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <button class="btn btn-success mt-2 col-sm-2" type="submit">Create</button>
    </form>
@endsection
