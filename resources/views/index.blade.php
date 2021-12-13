@extends('layout.app')

@section('content')
    <div class="starter-template">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('warning'))
            <div class="alert alert-warning">{{ session('warning') }}</div>
        @endif
        <h1>Все товары</h1>
        <form action="{{ route('index') }}">
            <div class="filters row">
                <div class="col-sm-6 col-md-3">
                    <label for="price_from">Цена от <input type="text" name="price_from" id="price_from" size="6"
                                                           value="{{ request('price_from') }}">
                    </label>
                    <label for="price_to">до <input type="text" name="price_to" id="price_to" size="6"
                                                    value="{{ request('price_to') }}">
                    </label>
                </div>
                <div class="col-sm-2 col-md-2">
                    <label for="hit">
                        <input type="checkbox" name="labels[]" id="hit" value="hit" @if(isset(request()->labels) && in_array('hit', request()->labels)) checked @endif> Хит </label>
                </div>
                <div class="col-sm-2 col-md-2">
                    <label for="new">
                        <input type="checkbox" name="labels[]" id="new" value="new" @if(isset(request()->labels) && in_array('new', request()->labels)) checked @endif> Новинка </label>
                </div>
                <div class="col-sm-2 col-md-2">
                    <label for="recommended">
                        <input type="checkbox" name="labels[]" id="recommended" value="recommended" @if(isset(request()->labels) && in_array('recommended', request()->labels)) checked @endif> Рекомендуем
                    </label>
                </div>
                <div class="col-sm-6 col-md-3">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('index') }}" class="btn btn-warning">Reset</a>
                </div>
            </div>
        </form>
        <div class="row">
            @foreach($products as $product)
                @include('card')
            @endforeach
        </div>
        {{ $products->links() }}
    </div>
@endsection

