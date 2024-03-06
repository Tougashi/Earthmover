@extends('Layouts.index')
@section('content') 
<div class="container-fluid mb-4">
    <div class="card shadow custom-rounded mb-4">
        <div class="card-body p-4">
            <form id="productForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-body mt-4">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="border border-3 border-dark p-4 custom-rounded">
                                <div class="mb-3">
                                    @error('image.*')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <label  for="inputProductDescription" class="form-label">Image | Min. 01 Max. 05</label>
                                    <input id="image-uploadify" type="file" name="image[]" accept=".xlsx,.xls,image/*,.doc,audio/*,.docx,video/*,.ppt,.pptx,.txt,.pdf" class="form-control" multiple>   
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="border border-dark border-3 p-4 custom-rounded">
                                <div class="row g-3">
                                    {{-- <div class="col-12">
                                        <label for="inputCode" class="form-label">Code | Optional</label>
                                        <input type="text" name="code" class="form-control border-dark border-2" id="inputCode" placeholder="#C0D3" required>
                                    </div> --}}
                                    <div class="col-12">
                                        <label for="inputTitle" class="form-label">Name</label>
                                        <input type="text" name="name" class="form-control border-dark border-2" id="inputProductName" placeholder="Enter Product Name" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="inputDescription" class="form-label">Description</label>
                                        <textarea class="form-control border-dark border-2" name="description" id="inputProductDescription" rows="3" placeholder="Enter Product Detail"></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputPrice" class="form-label">Price</label>
                                        <input type="number" name="price" class="form-control border-dark border-2" id="inputPrice" placeholder="00.00" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputStock" class="form-label">Stock</label>
                                        <input type="number" name="stock" class="form-control border-dark border-2" id="inputStock" placeholder="00.00" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="inputCategory" class="form-label">Category</label>
                                        <select class="form-select border-dark border-2" id="inputCategory" name="categoryId" required>
                                            <option selected disabled>Choose...</option>
                                            @foreach ($category as $item)    
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label for="inputSupplier" class="form-label">Supplier</label>
                                        <select class="form-select border-dark border-2" id="inputSupplier" name="supplierId" required>
                                            <option selected disabled>Choose...</option>
                                            @foreach ($supplier as $item)    
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button type="button" id="submitBtn" class="btn btn-dark custom-rounded">Save Product</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')

<script>
    $(document).ready(function () {
        $('#image-uploadify').imageuploadify();
    })

    $(document).ready(function () {
        $('#submitBtn').click(function (e) {
            e.preventDefault();

            let productName = $('#inputProductName').val().trim();
            let productDescription = $('#inputProductDescription').val().trim();
            let category = $('#inputCategory').val().trim();
            let price = $('#inputPrice').val().trim();
            let stock = $('#inputStock').val().trim();
            let supplier = $('#inputSupplier').val().trim();

            if (!productName || !productDescription || !price || !stock || !category) {
                Swal.fire({
                    title: 'Warning',
                    text: 'Please fill in all required fields except Image',
                    icon: 'warning',
                    confirmButtonText: 'OK',
                    allowOutsideClick: false
                });
                return;
            }

            $.ajax({
                url: "{{ route('products.add') }}",
                type: "POST",
                data: new FormData($('#productForm')[0]),
                contentType: false,
                processData: false,
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000 
                    });
                    window.location.reload();
                    $('#productForm')[0].reset();
                    loadProducts(); 
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });

</script>

@endpush
@endsection
