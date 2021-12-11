@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-12">
            <h1>Orders</h1>
            <table class="table">
                <tbody>
                <tr>
                    <th>
                        #
                    </th>
                    <th>
                        Имя
                    </th>
                    <th>
                        Телефон
                    </th>
                    <th>
                        Когда отправлен
                    </th>
                    <th>
                        Сумма
                    </th>
                    <th>
                        Действия
                    </th>
                </tr>
                @forelse($orders as $order)
                    <tr>
                        <td>{{ $order->id}}</td>
                        <td>{{ $order->name }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>{{ $order->created_at->format('H:i d/m/Y') }}</td>
                        <td>{{ $order->getTotalSum() }} руб.</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a class="btn btn-success" type="button"
                                   href="{{ route('user.orders.show', $order) }}">Show</a>
                            </div>
                        </td>
                    </tr>
                @empty
                      <tr>
                          <td colspan="6">No orders yet.</td>
                      </tr>
                @endforelse
                </tbody>
            </table>
            {{ $orders->links() }}
        </div>
    </div>
@endsection
