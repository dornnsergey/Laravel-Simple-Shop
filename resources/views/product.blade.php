@extends('layout.app')

@section('content')
    <div class="starter-template">
        <h1>{{ $product->name }}</h1>
        <h2>{{ $product->category->name }}</h2>
        <p>Цена: <b>{{ $product->price }} ₽</b></p>
        <img src="http://internet-shop.tmweb.ru/storage/products/iphone_x.jpg">
        <p>{{ $product->text }}</p>

        <form action="{{ route('add-to-cart', $product->id) }}" method="POST">
            <button type="submit" class="btn btn-success" role="button">Добавить в корзину</button>
            @csrf
        </form>
    </div>
@endsection

