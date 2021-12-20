@extends('layouts.app')

@section('content')
    <div class="col-md-12">
        <h1>Product {{ $product->name }}</h1>
        <table class="table">
            <tbody>
            <tr>
                <th>Field</th>
                <th>Value</th>
            </tr>
            <tr>
                <td>ID</td>
                <td>{{ $product->id }}</td>
            </tr>
            <tr>
                <td>Slug</td>
                <td>{{ $product->slug }}</td>
            </tr>
            <tr>
                <td>Name</td>
                <td>{{ $product->name }}</td>
            </tr>
            <tr>
                <td>Description</td>
                <td>{{ $product->description }}</td>
            </tr>
            <tr>
                <td>Image</td>
                <td><img src="{{ Storage::url($product->image) }}"
                         height="240px"></td>
            </tr>
            <tr>
                <td>Category</td>
                <td>{{ $product->category->name }}</td>
            </tr>
            <tr>
                <td>Labels</td>
                <td>
                    @forelse($product->labels as $label)
                        <span class="badge bg-success">{{ $label->name }}</span>
                    @empty
                    @endforelse
                </td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection

