@extends('layout.admin')
@section('title', $title)

@section('content')
        
        <div class="card mb-3" style="max-width: 540px;">
            <div class="row g-0">
                <div class="col-md-4">
                    {{-- Product Images --}}
                    @if(count($product->images) != 0)
                        <img src="{{ asset('storage/'. $product->images[0]->name) }}" class="card-img-top" alt{{ $product->title }}">
                    @else
                        <img src="{{ asset('assets/default-product.png') }}" class="card-img-top" alt="{{ $product->title }}">
                    @endif
                    {{-- End of Product Images --}}
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                    <h5 class="card-title">{{ $product->title }}</h5>
                    <p class="card-text">{{ $product->desc }}</p>
                    <h5 class="card-title">@currency($product->harga)</h5>
                    <p class="card-text"><small class="text-muted">Sisa stock {{ $product->stock }}</small></p>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection