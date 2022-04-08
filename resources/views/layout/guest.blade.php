<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <title>UMKM E-commerce</title>
</head>
<body>
    <div class="main-wrapper">
        @auth
        <header>
            <nav>
                <ul>
                    <li><a href="{{ route('product.index') }}">Home</a></li>
                    <li><a href="{{ route('product.create') }}">Add Product</a></li>
                    <li><a href="#">{{ auth()->user()->name }}</a></li>
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </ul>
            </nav>
        </header>
        @endauth
        
        @yield('content')
    </div>
</body>
</html>