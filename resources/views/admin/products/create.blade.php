@extends('layouts.app')

@section('content')
    <h1>Add product</h1>
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="input-group row mb-2">
            <label class="form-label col-sm-2" for="slug">Slug</label>
            <div class="col-sm-6">
                <input class="form-control @error('slug') is-invalid @enderror" name="slug" id="slug"
                       value="{{ old('slug') }}">
                @error('slug')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="input-group row mb-2">
            <label class="form-label col-sm-2" for="name">Name</label>
            <div class="col-sm-6">
                <input class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                       value="{{ old('name') }}">
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
            <label class="form-label col-sm-2" for="price">Price</label>
            <div class="col-sm-6">
                <input class="form-control @error('price') is-invalid @enderror" name="price"
                       id="price" value="{{ old('price') }}">
                @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="input-group row mb-2">
            <label class="form-label col-sm-2" for="category_id">Product category</label>
            <div class="col-sm-6">
                <select class="form-control @error('category_id') is-invalid @enderror" name="category_id"
                        id="category_id">
                    <option value="0"> ---SELECT CATEGORY---</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
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
        @foreach($labels as $label)
            <div class="form-check form-check-inline mt-2">
                <input class="form-check-input" type="checkbox" name="labels[]" id="{{ $label->name }}" value="{{ $label->name }}">
                <label class="form-check-label" for="{{ $label->name }}">{{ $label->name }}</label>
            </div>
        @endforeach
        <button class="d-block btn btn-success mt-2 col-sm-2" type="submit">Create</button>
    </form>
@endsection
