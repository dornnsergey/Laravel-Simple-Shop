@extends('layouts.app')

@section('content')
    <div class="col-md-12">
        <h1>Products</h1>
        @if(session('message'))
            <div class="alert alert-warning">{{ session('message') }}</div>
        @endif
        <table class="table table-striped">
            <tbody>
            <tr>
                <th>#</th>
                <th>Code</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th class="col-md-3">Actions</th>
            </tr>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->code }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST">
                                <a class="btn btn-success" type="button" href="{{ route('admin.products.show', $product) }}">Show</a>
                                <a class="btn btn-warning" type="button" href="{{ route('admin.products.edit', $product) }}">Edit</a>
                                @csrf
                                @method('DELETE')
                                <input class="btn btn-danger" type="submit" value="Delete"></form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $products->links() }}
        <a class="btn btn-success" type="button"
           href="{{ route('admin.products.create') }}">Add product</a>
    </div>
@endsection
