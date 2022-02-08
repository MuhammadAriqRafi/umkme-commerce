@extends('layout.admin')

@section('content')

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Howdy! {{ auth()->user()->name }}</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <a href="{{ route('products.create') }}" class="btn btn-sm btn-outline-secondary">Add Product</a>
                </div>
            </div>
        </div>

        @if(session()->has('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif

        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($products as $product)
            <div class="col">
                <div class="card">
                    <img src="{{ asset('assets/default-product.png') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <a href="{{ route('products.show', ['product' => $product->id]) }}">
                            <h5 class="card-title">{{ $product->title }}</h5>
                            <p class="card-text mb-3">{{ $product->desc }}</p>
                        </a>
                        <div class="btn-group">
                            <form action="{{ route('products.edit', ['product' => $product->id]) }}" method="GET">
                                <button type="submit" class="btn btn-primary">Edit</button>
                            </form>
                            <form action="{{ route('products.destroy', ['product' => $product->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </main>

@endsection