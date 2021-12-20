@extends('layout.app')

@section('content')
    <div class="starter-template">
        @if(session('message'))
        <p class="alert alert-success">{{ session('message') }}</p>
        @endif
        <h1>Cart</h1>
        <p>Checkout</p>
        <div class="panel">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Count</th>
                    <th>Price</th>
                    <th>Total price</th>
                </tr>
                </thead>
                <tbody>
                @forelse($order->products as $product)
                <tr>
                    <td>
                        <a href="{{ route('shop.products.show', $product->slug) }}">
                            <img height="56px" src="{{ Storage::url($product->image) }}">
                            {{ $product->name }}
                        </a>
                    </td>
                    <td><span class="badge">{{ $product->pivot->count }}</span>
                        <div class="btn-group form-inline">
                            <form action="{{ route('remove_from_cart', $product) }}" method="POST">
                                <button type="submit" class="btn btn-danger"><span
                                        class="glyphicon glyphicon-minus" aria-hidden="true"></span></button>
                                @csrf
                            </form>
                            <form action="{{ route('add_to_cart', $product) }}" method="POST">
                                <button type="submit" class="btn btn-success"><span
                                        class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
                                @csrf
                            </form>
                        </div>
                    </td>
                    <td>{{ $product->price }} $</td>
                    <td>{{ $product->getTotalSum() }} $</td>
                </tr>
                @empty
                    <tr>
                        <td>Here is nothing.</td>
                    </tr>
                @endforelse
                <tr>
                    <td colspan="3">Total cost:</td>
                    <td>{{ $order->getTotalSum() }} $</td>
                </tr>
                </tbody>
            </table>
            <br>
            <div class="btn-group pull-right" role="group">
                <a type="button" class="btn btn-success" href="{{ route('order') }}">
                   Confirm
                </a>
            </div>
        </div>
    </div>
@endsection
