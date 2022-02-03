@extends('layout.main')

@section('content')
    <h1>Products Create</h1>

    <form action="/products" method="POST">
        @csrf
        <div class="input-group">
            <label>Title</label>
            <input type="text" name="title">
        </div>
        <div class="input-group">
            <label>Description</label>
            <input type="text" name="desc">
        </div>
        <div class="input-group">
            <label>Harga</label>
            <input type="number" name="harga">
        </div>
        <button type="submit">Create</button>
    </form>
@endsection