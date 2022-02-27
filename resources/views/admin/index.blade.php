@extends('layout.admin')
@section('title', $title)

@section('content')

    <a href="{{ route('products.create') }}" class="btn btn-sm btn-outline-secondary mb-3">Add Product</a>
        
    @if(session()->has('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach ($products as $product)
        <div class="col">
            <div class="card">
                {{-- Product Images --}}
                @if(count($product->images) != 0)
                    <img src="{{ asset('storage/'. $product->images[0]->name) }}" height="300" class="card-img-top" alt="...">
                @else
                    <img src="{{ asset('assets/default-product.png') }}" height="300" class="card-img-top" alt="...">
                @endif
                {{-- End of Product Images --}}
                <div class="card-body">
                    <a href="{{ route('products.show', ['product' => $product->id]) }}">
                        <h5 class="card-title">{{ $product->title }}</h5>
                        <p class="card-text mb-3">{{ $product->desc }}</p>
                    </a>
                    <div class="btn-group">
                        <form action="{{ route('products.edit', ['product' => $product->id]) }}" method="GET">
                            <button type="submit" class="btn btn-primary" style="margin-right: 8px;">Edit</button>
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

@endsection