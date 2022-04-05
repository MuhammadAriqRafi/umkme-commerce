@extends('layout.admin')
@section('title', $title)

@section('toolbar')

    <div class="btn-toolbar mb-2 mb-md-0">
        <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#myModal"><span data-feather="plus"></span> Add Product</button>

        {{-- Add Product Modal --}}
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Add Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" id="createProduct">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="image" class="col-form-label">Image</label>
                                <img class="img-preview-add img-fluid rounded-3 mb-3">
                                <input type="file" class="form-control" id="image" name="image" onchange="previewImage(this, 'img-preview-add')">
                                <span class="error-message image_error text-danger"></span>
                            </div>
                            <div class="mb-3">
                                <label for="title" class="col-form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title" onclick="disableIsInvalidClass(this)">
                                <span class="error-message title_error text-danger"></span>
                            </div>
                            <div class="mb-3">
                                <label for="harga" class="col-form-label">Harga</label>
                                <input type="number" class="form-control" id="harga" name="harga" onclick="disableIsInvalidClass(this)">
                                <span class="error-message harga_error text-danger"></span>
                            </div>
                            <div class="mb-3">
                                <label for="stock" class="col-form-label">Stock</label>
                                <input type="number" min="1" class="form-control" id="stock" name="stock" onclick="disableIsInvalidClass(this)">
                                <span class="error-message stock_error text-danger"></span>
                            </div>
                            <div class="mb-3">
                                <label for="desc" class="col-form-label">Description</label>
                                <textarea class="form-control" id="desc" onclick="disableIsInvalidClass(this)" name="desc">{{ old('desc') }}</textarea>
                                <span class="error-message desc_error text-danger"></span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- End of Add Product Modal --}}
    </div>

@endsection

@section('content')

    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <table class="table" id="productTable">
        <thead>
            <tr>
                <th scope="col">Image</th>
                <th scope="col">Title</th>
                <th scope="col">Harga</th>
                <th scope="col">Stock</th>
                <th scope="col">Description</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    @if($product->image)
                        <td><img src="{{ asset($product->image) }}" height="100" width="100" class="rounded" alt="{{ $product->name }} Image"></td>
                    @else
                        <td><img src="{{ asset('assets/default-product.png') }}" height="100" width="100" class="rounded" alt="{{ $product->name }} Image"></td>
                    @endif
                    <td>{{ $product->title }}</td>
                    <td>Rp. @currency($product->harga)</td>
                    <td>@currency($product->stock)</td>
                    <td>{{ $product->desc }}</td>
                    <td>
                        <form action="{{ route('admin.products.edit', ['product' => $product->id]) }}">
                            <button type="submit" class="btn btn-sm btn-warning">Edit</button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('admin.products.destroy', ['product' => $product->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
        </tbody>
    </table>

@endsection

@section('script')

    <script>
        const disableIsInvalidClass = (element) => {
            $(element).removeClass('is-invalid');
        }

        // TODO: Add Product
        $('#createProduct').on('submit', function(e){
            e.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: new FormData(this),
                processData: false,
                dataType: "json",
                contentType: false,
                beforeSend: function() {
                    $(document).find('span.error-message').text('');
                },
                success: function (response) {
                    if(response.status === 0){
                        $.each(response.error, function (prefix, value) { 
                            $('span.' + prefix + '_error').text(value[0]);
                            $(`#createProduct #${prefix}`).addClass('is-invalid');
                        });
                    } else {
                        let deleteUrl = `{{ route('admin.products.destroy', ':id') }}`;
                        deleteUrl = deleteUrl.replace(':id', response.data.id);
                        let editUrl = `{{ route('admin.products.edit', ':id') }}`;
                        editUrl = editUrl.replace(':id', response.data.id);
                        let imageName = response.data.image != null ? `storage/${response.data.image}` : 'assets/default-product.png';

                        $('#productTable tbody').prepend(`
                            <tr>
                                <td><img src="{{ asset('${imageName}') }}" height="100" width="100" class="rounded" alt="${response.data.name} Image"></td>
                                <td>${response.data.title}</td>
                                <td>Rp. ${response.data.harga}</td>
                                <td>${response.data.stock}</td>
                                <td>${response.data.desc}</td>
                                <td>
                                    <form action="${editUrl}">
                                        <button type="submit" class="btn btn-sm btn-warning">Edit</button>
                                    </form>
                                </td>
                                <td>
                                    <form action="${deleteUrl}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        `);
                        $('#createProduct')[0].reset();
                        alert(response.msg);
                    }
                }
            });
        });
        // End of Add Product

        // TODO: Show Product
        // TODO: Get All Product
        // TODO: Delete Product
    </script>

@endsection