@extends('layout.admin')
@section('title', $title)

@section('content')
        
        @if(session()->has('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif

        <form action="/products" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="Title" name="title">
                <label for="floatingInput">Title</label>
            </div>
            <div class="form-floating mb-3">
                <textarea class="form-control" placeholder="Description" id="floatingTextarea2" style="height: 100px" name="desc"></textarea>
                <label for="floatingTextarea2">Description</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="Harga" name="harga">
                <label for="floatingInput">Harga</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="Stock" name="stock">
                <label for="floatingInput">Stock</label>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <img class="img-preview img-fluid">
                <input class="form-control @error('image') is-invalid @enderror" onchange="previewImg()" type="file" id="image" name="image">
            </div>
            <button type="submit" class="btn btn-success mt-5">Create</button>
        </form>
    </main>

    <script>
        function previewImg() {
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');
            
            imgPreview.style.display = 'block';
            
            const oFReader = new FileReader();
            console.log(oFReader);
            oFReader.readAsDataURL(image.files[0]);
            console.log(oFReader);


            oFReader.onlaod = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
                console.log(oFREvent.target.result);
            }
        }
    </script>

@endsection