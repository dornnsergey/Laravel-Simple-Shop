@extends('layouts.app')

@section('content')
    <h1>Add category</h1>
    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="input-group row mb-2">
            <label class="form-label col-sm-2" for="code">Code</label>
            <div class="col-sm-6">
                <input class="form-control" name="code" id="code" value="{{ old('code') }}">
            </div>
        </div>
        <div class="input-group row mb-2">
            <label class="form-label col-sm-2" for="name">Name</label>
            <div class="col-sm-6">
                <input class="form-control" name="name" id="name" value="{{ old('name') }}">
            </div>
        </div>
        <div class="input-group row mb-2">
            <label class="form-label col-sm-2" for="description">Description</label>
            <div class="col-sm-6">
                <textarea class="form-control" rows="8" name="description"
                          id="description">{{ old('description') }}</textarea>
            </div>
        </div>
        <div class="input-group row mb-2">
            <label class="form-label col-sm-2" for="image">Image</label>
            <div class="col-sm-6">
                <input class="form-control" type="file" name="image" id="image">
            </div>
        </div>
        <button class="btn btn-success mt-2 col-sm-2" type="submit">Create</button>
    </form>
@endsection
