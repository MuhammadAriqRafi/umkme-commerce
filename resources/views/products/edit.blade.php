@extends('layout.admin')

@section('content')

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Edit Product</h1>
        </div>
        
        @if(session()->has('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif

        <form action="{{ route('products.update', ['product' => $product->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="Title" name="title" value="{{ $product->title }}">
                <label for="floatingInput">Title</label>
            </div>
            <div class="form-floating mb-3">
                <textarea class="form-control" placeholder="Description" id="floatingTextarea2" style="height: 100px">{{ $product->desc }}</textarea>
                <label for="floatingTextarea2">Description</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="Harga" name="harga" value="{{ $product->harga }}">
                <label for="floatingInput">Harga</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="Stock" name="stock" value="{{ $product->stock }}">
                <label for="floatingInput">Stock</label>
            </div>
            <button type="submit" class="btn btn-success mt-5">Update</button>
        </form>
    </main>

@endsection