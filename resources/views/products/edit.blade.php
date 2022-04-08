@extends('layout.admin')
@section('title', $title)

@section('content')

    @if(session()->has('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form action="{{ route('admin.products.update', ['product' => $product->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="image" class="col-form-label">Image</label>
            <img class="img-preview-add img-fluid rounded-3 mb-3">
            <input type="file" class="form-control" id="image" name="image" onchange="previewImage(this, 'img-preview-add')">
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" placeholder="Title" name="title" value="{{ $product->title }}">
            <label for="floatingInput">Title</label>
            @error('title')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-floating mb-3">
            <textarea class="form-control" placeholder="Description" id="floatingTextarea2" style="height: 100px" name="desc">{{ $product->desc }}</textarea>
            <label for="floatingTextarea2">Description</label>
            @error('desc')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" placeholder="Harga" name="harga" value="{{ $product->harga }}">
            <label for="floatingInput">Harga</label>
            @error('harga')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" placeholder="Stock" name="stock" value="{{ $product->stock }}">
            <label for="floatingInput">Stock</label>
            @error('stock')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-success mt-5">Update</button>
    </form>

@endsection