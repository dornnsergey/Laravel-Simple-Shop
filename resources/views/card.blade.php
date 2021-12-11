<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <div class="labels">

        </div>
        <img src="{{ Storage::url($product->image) }}">
        <div class="caption">
            <h3>{{ $product->name }}</h3>
            <div>{{ $product->category->name }}</div>
            <p>{{ $product->price }}</p>
            <p>
            <form action="{{ route('add-to-cart', $product) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary" role="button">В корзину</button>
                <a href="{{ route('product', [$product->category->code, $product->code]) }}"
                   class="btn btn-default"
                   role="button">Подробнее</a>
            </form>
            </p>
        </div>
    </div>
</div>
