@extends('layout.main')

@section('content')
    <h1>Products Edit</h1>

    <form action="/products/{{ $product->id }}" method="POST">
        @method('PUT')
        @csrf
        <div class="input-group">
            <label>Title</label>
            <input type="text" name="title" value="{{ $product->title }}">
        </div>
        <div class="input-group">
            <label>Description</label>
            <input type="text" name="desc" value="{{ $product->desc }}">
        </div>
        <div class="input-group">
            <label>Harga</label>
            <input type="number" name="harga" value="{{ $product->harga }}">
        </div>
        <button type="submit">Update</button>
    </form>
@endsection