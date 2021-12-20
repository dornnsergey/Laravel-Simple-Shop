@extends('layouts.app')

@section('content')
    <div class="col-md-12">
        <h1 class="text-center">Products</h1>
        <a class="btn btn-success mb-2" type="button"
           href="{{ route('admin.products.create') }}">Add product</a>
        @if(session('message'))
            <div class="alert alert-warning">{{ session('message') }}</div>
        @endif
        <table class="table table-striped">
            <tbody>
            <tr>
                <th>#</th>
                <th>Slug</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th class="col-md-3"></th>
            </tr>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->slug }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST">
                                <a class="btn btn-success" type="button"
                                   href="{{ route('admin.products.show', $product) }}">Show</a>
                                <a class="btn btn-warning" type="button"
                                   href="{{ route('admin.products.edit', $product) }}">Edit</a>
                                @csrf
                                @method('DELETE')
                                <input class="btn btn-danger" type="submit" value="Delete"
                                       onclick="return confirm('Are you sure?')"></form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $products->links() }}
    </div>
@endsection
