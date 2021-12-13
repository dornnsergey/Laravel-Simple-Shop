<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <div class="labels">
            @forelse($product->labels as $label)
                <span class="badge badge-danger">{{ $label->name }}</span>
            @empty
            @endforelse
        </div>
        <img src="{{ Storage::url($product->image ?? 'products/133x200.png') }}" >
        <div class="caption">
            <h3>{{ $product->name }}</h3>
            <div>{{ $category->name ?? $product->category->name}}</div>
            <p>{{ $product->price }}</p>
            <p>
            <form action="{{ route('add-to-cart', $product) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary" role="button">Add to cart</button>
                <a href="{{ route('product', [$category->code ?? $product->category->code, $product->code]) }}"
                   class="btn btn-default"
                   role="button">Show</a>
            </form>
            </p>
        </div>
    </div>
</div>
