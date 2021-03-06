@extends('layout.app')

@section('content')
    <div class="starter-template">
        <h1>{{ $product->name }}</h1>
        <h4>{{ $product->category->name }}</h4>
        <p>Price: <b>{{ $product->price }} ₽</b></p>
        <img src="{{ Storage::url($product->image) }}" height="300px" width="200px">
        <p>{{ $product->description }}</p>

        <form action="{{ route('add_to_cart', $product->id) }}" method="POST">
            <button type="submit" class="btn btn-success" role="button">Add to cart</button>
            @csrf
        </form>
    </div>
@endsection

