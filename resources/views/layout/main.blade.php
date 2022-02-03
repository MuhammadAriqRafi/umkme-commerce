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
        <header>
            <nav>
                <ul>
                    <li><a href="{{ route('product.index') }}">Home</a></li>
                    <li><a href="{{ route('product.create') }}">Add Product</a></li>
                </ul>
            </nav>
        </header>
        
        @yield('content')
    </div>
</body>
</html>