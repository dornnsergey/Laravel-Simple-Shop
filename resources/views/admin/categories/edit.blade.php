@extends('layouts.app')

@section('content')
    <h1>Edit category</h1>
    <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="input-group row mb-2">
            <label class="form-label col-sm-2" for="code">Code</label>
            <div class="col-sm-6">
                <input class="form-control" name="code" id="code" value="{{ old('code', $category->code) }}">
            </div>
        </div>
        <div class="input-group row mb-2">
            <label class="form-label col-sm-2" for="name">Name</label>
            <div class="col-sm-6">
                <input class="form-control" name="name" id="name" value="{{ old('name', $category->name) }}">
            </div>
        </div>
        <div class="input-group row mb-2">
            <label class="form-label col-sm-2" for="description">Description</label>
            <div class="col-sm-6">
                <textarea class="form-control" rows="8" name="description"
                          id="description">{{ old('description', $category->description) }}</textarea>
            </div>
        </div>
        <div class="input-group row mb-2">
            <label class="form-label col-sm-2" for="image">Image</label>
            <div class="col-sm-6">
                <input class="form-control" type="file" name="image" id="image">
            </div>
        </div>
        <button class="btn btn-success mt-2 col-sm-2" type="submit">Save</button>
    </form>
@endsection

