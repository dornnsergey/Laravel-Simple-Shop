@extends('layout.app')

@section('content')
    <div class="starter-template">
        @if(session('message'))
        <p class="alert alert-success">{{ session('message') }}</p>
        @endif
        <h1>Корзина</h1>
        <p>Оформление заказа</p>
        <div class="panel">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Название</th>
                    <th>Кол-во</th>
                    <th>Цена</th>
                    <th>Стоимость</th>
                </tr>
                </thead>
                <tbody>
                @forelse($order->products as $product)
                <tr>
                    <td>
                        <a href="{{ route('product', [$product->category->code, $product->code]) }}">
                            <img height="56px" src="http://internet-shop.tmweb.ru/storage/products/iphone_x.jpg">
                            {{ $product->name }}
                        </a>
                    </td>
                    <td><span class="badge">{{ $product->pivot->count }}</span>
                        <div class="btn-group form-inline">
                            <form action="{{ route('remove-from-cart', $product->id) }}" method="POST">
                                <button type="submit" class="btn btn-danger"><span
                                        class="glyphicon glyphicon-minus" aria-hidden="true"></span></button>
                                @csrf
                            </form>
                            <form action="{{ route('add-to-cart', $product->id) }}" method="POST">
                                <button type="submit" class="btn btn-success"><span
                                        class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
                                @csrf
                            </form>
                        </div>
                    </td>
                    <td>{{ $product->price }} ₽</td>
                    <td>{{ $product->getTotalSum() }} ₽</td>
                </tr>
                @empty
                    <tr>
                        <td>Here is nothing.</td>
                    </tr>
                @endforelse
                <tr>
                    <td colspan="3">Общая стоимость:</td>
                    <td>{{ $order->getTotalSum() }} ₽</td>
                </tr>
                </tbody>
            </table>
            <br>
            <div class="btn-group pull-right" role="group">
                <a type="button" class="btn btn-success" href="{{ route('order') }}">Оформить
                    заказ</a>
            </div>
        </div>
    </div>
@endsection
