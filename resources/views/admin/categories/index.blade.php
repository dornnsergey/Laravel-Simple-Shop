@extends('layouts.app')

@section('content')
    <div class="col-md-12">
        <h1 class="text-center">Categories</h1>

        <a class="btn btn-success mb-2" type="button"
           href="{{ route('admin.categories.create') }}">Add category</a>

        @if(session('message'))
            <div class="alert alert-warning">{{ session('message') }}</div>
        @endif
        <table class="table table-striped">
            <tbody>
            <tr>
                <th>#</th>
                <th>Slug</th>
                <th>Name</th>
                <th class="col-md-4"></th>
            </tr>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->slug }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST">
                                <a class="btn btn-success" type="button"
                                   href="{{ route('admin.categories.show', $category) }}">Show</a>
                                <a class="btn btn-warning" type="button"
                                   href="{{ route('admin.categories.edit', $category) }}">Edit</a>
                                @csrf
                                @method('DELETE')
                                <input class="btn btn-danger" type="submit" value="Delete"></form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
