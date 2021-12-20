@extends('layouts.app')

@section('content')
    <h1>Edit category</h1>
    <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="input-group row mb-2">
            <label class="form-label col-sm-2" for="slug">Slug</label>
            <div class="col-sm-6">
                <input class="form-control @error('slug') is-invalid @enderror" name="slug" id="slug"
                       value="{{ old('slug', $category->slug) }}">
                @error('slug')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="input-group row mb-2">
            <label class="form-label col-sm-2" for="name">Name</label>
            <div class="col-sm-6">
                <input class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                       value="{{ old('name', $category->name) }}">
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="input-group row mb-2">
            <label class="form-label col-sm-2" for="description">Description</label>
            <div class="col-sm-6">
                <textarea class="form-control @error('description') is-invalid @enderror" rows="8" name="description"
                          id="description">{{ old('description', $category->description) }}</textarea>
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
        <button class="btn btn-success mt-2 col-sm-2" type="submit">Save</button>
    </form>
@endsection

