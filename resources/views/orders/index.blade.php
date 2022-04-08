@extends('layout.admin')
@section('title', $title)

@section('toolbar')

    <div class="d-flex justify-content-end">
        <div class="dropdown">
            <button class="btn btn-sm btn-outline-info dropdown-toggle mb-3" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
            Status
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="{{ route('admin.orders.index') }}">All</a></li>
                @foreach ($orderStatuses as $status)
                    <li><a class="dropdown-item" href="{{ route('admin.orders.index') . "?status=$status->id" }}">{{ $status->status }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>

@endsection

@section('content')

    @if(session()->has('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @if(count($orders) > 0)
            @foreach ($orders as $order)
                <div class="col">
                    <a href="{{ route('admin.orders.show', ['order' => $order->id]) }}">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-text mb-3">{{ $order->status->status }}</p>
                                <h5 class="card-title">{{ $order->pembeli->name }}</h5>
                                @if($order->products)
                                    <ul>
                                        @foreach ($order->products as $product)
                                        <li>
                                            <h6 class="card-title">{{ $product->title }}</h6>
                                        </li>
                                        @endforeach
                                    </ul>
                                    <h6 class="card-title mt-2">Rp. @currency($order->products->sum('harga'))</h6>
                                @endif
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
                    </a>
                </div>
            @endforeach
        @else
            <p>Belum ada orderan</p>
        @endif
    </div>
    
@endsection