@extends('layout.main')

@section('content')
    <h1>Products Index</h1>

    <div class="product">
        @foreach ($products as $product)
        <a href="/products/{{ $product->id }}">
            <div class="product__item">
                <h2 class="product__title">{{ $product->title }}</h1>
                <p class="product__desc">{{ $product->desc }}</p>
                <h3 class="product__harga">{{ $product->harga }}</h3>
                <a href="/products/{{ $product->id }}/edit">Edit</a>
                <form action="/products/{{ $product->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </div>
        </a>
        @endforeach
    </div>
@endsection