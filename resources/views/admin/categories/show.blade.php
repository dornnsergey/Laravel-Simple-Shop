@extends('layouts.app')

@section('content')
    <div class="col-md-12">
        <h1>Category {{ $category->name }}</h1>
        <table class="table">
            <tbody>
            <tr>
                <th>Field</th>
                <th>Value</th>
            </tr>
            <tr>
                <td>ID</td>
                <td>{{ $category->id }}</td>
            </tr>
            <tr>
                <td>Slug</td>
                <td>{{ $category->slug }}</td>
            </tr>
            <tr>
                <td>Name</td>
                <td>{{ $category->name }}</td>
            </tr>
            <tr>
                <td>Description</td>
                <td>{{ $category->description }}</td>
            </tr>
            <tr>
                <td>Image</td>
                <td><img src="{{ Storage::url($category->image) }}"
                         height="240px"></td>
            </tr>
            <tr>
                <td>Products count</td>
                <td>{{ $category->products->count() }}</td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection

