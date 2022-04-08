@extends('layout.admin')
@section('title', $title)

@section('content')
        
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <p class="card-text mb-1">{{ $order->status->status }}</p>
                        <h6 class="card-title mb-4">{{ $order->paymentMethod->metode }}</h6>
                        <h4 class="card-title mb-2">{{ $order->pembeli->name }}</h4>
                        <p class="card-title mb-0">{{ $order->pembeli->phone }}</p>
                        <p class="card-title mb-3">{{ $order->pembeli->alamat }}</p>
                        <h6 class="card-title mb-1">Items</h6>
                        <ul>
                            @foreach ($order->products as $product)
                                <li>
                                    <h6 class="card-title">{{ $product->title }}</h6>
                                </li>    
                            @endforeach
                        </ul>
                        <h5 class="card-title mt-5">Rp. @currency($order->products->sum('harga'))</h5>
                        @if($order->status->id != 2)
                            <form action="{{ route('admin.orders.update', ['order' => $order->id]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-sm btn-primary mt-3">Terkirim</button>
                            </form>
                        @else
                            <p class="card-text mb-3 me-auto">Sent at {{ $order->updated_at->format('d M Y, H:i') }}</p>
                        @endif
                    </div>
                </div>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-info mt-5"><span data-feather="arrow-left"></span> Back</a>
            </div>
        </div>
    </main>

@endsection