@extends('layout.admin')
@section('title', $title)

@section('content')

    @if(session()->has('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form action="{{ route('admin.products.update', ['product' => $product->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" placeholder="Title" name="title" value="{{ $product->title }}">
            <label for="floatingInput">Title</label>
        </div>
        <div class="form-floating mb-3">
            <textarea class="form-control" placeholder="Description" id="floatingTextarea2" style="height: 100px" name="desc">{{ $product->desc }}</textarea>
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

@endsection