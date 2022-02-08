@extends('layout.admin')

@section('content')

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Howdy! {{ auth()->user()->name }}</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <button type="button" class="btn btn-sm btn-outline-secondary">Add Product</button>
                </div>
            </div>
        </div>
        
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
                <div class="card">
                    <img src="{{ asset('assets/default-product.png') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h4 class="card-title">{{ $product->title }}</h4>
                        <p class="card-text">{{ $product->desc }}</p>
                        <h6 class="card-title">{{ $product->harga }}</h6>
                        <h6 class="card-title">{{ $product->stock }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection