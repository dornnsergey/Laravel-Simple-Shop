@extends('layout.app')

@section('content')
    <div class="starter-template">
        @foreach($categories as $category)
        <div class="panel">
            <a href="{{ route('category', $category->code) }}">
                <img src="{{ Storage::url($category->image) }}" height="100px">
                <h2>{{ $category->name }}</h2>
            </a>
            <p>
               {{ $category->description }}
            </p>
        </div>
        @endforeach
    </div>
@endsection

