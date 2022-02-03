@extends('layout.main')

@section('content')
    <h1>Products Show</h1>

    <div class="product">
        <h2 class="product__title">{{ $product->title }}</h1>
        <p class="product__desc">{{ $product->desc }}</p>
        <h3 class="product__harga">{{ $product->harga }}</h3>
    </div>
@endsection