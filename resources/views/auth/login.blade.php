<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login | Umkme-com</title>

        <!-- Bootstrap core CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
            font-size: 3.5rem;
            }
        }
        </style>
        
        <!-- Custom styles for this template -->
        <link href="{{ asset('css/signin.css') }}" rel="stylesheet">
    </head>
    <body class="text-center">
        
        <main class="form-signin">
        
            
            <form action="/" method="POST">
                @csrf
                <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

                @if(session()->has('error'))
                    <p style="color: red;">{{ session('error') }}</p>
                @endif
                
                <div class="form-floating">
                    <input type="email" class="form-control" id="floatingInput" name="email" value="{{ old('email') }}" placeholder="name@example.com">
                    <label for="floatingInput">Email address</label>
                    @error('email')
                        <p style="color: red;">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password">
                    <label for="floatingPassword">Password</label>
                </div>

                <button class="w-100 btn btn-lg btn-primary mb-3" type="submit">Sign in</button>
            </form>
        </main>
    </body>
</html>