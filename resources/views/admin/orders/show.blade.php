@extends('layouts.app')

@section('content')
    <div class="py-4">
        <div class="container">
            <div class="justify-content-center">
                <div class="panel">
                    <h1>Order №{{ $order->id }}</h1>
                    <p>Customer: <b>{{ $order->name }}</b></p>
                    <p>Phone: <b>{{ $order->phone }}</b></p>
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
                        @foreach ($order->products as $product)
                        <tr>
                            <td>
                                <a href="{{ route('product', [$product->category->code, $product->code])}}">
                                    <img src="{{Storage::url($product->image)}}" height="56px">
                                    {{ $product->name }}
                                </a>
                            </td>
                            <td><span class="badge bg-secondary">{{ $product->pivot->count }}</span></td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->getTotalSum() }}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="3">Total cost</td>
                            <td colspan="3">{{ $order->getTotalSum() }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
