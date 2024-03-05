@extends('Layouts.index')
@section('content') 
<x-back/>
<div class="container-fluid mb-4">
    <div class="card shadow custom-rounded mt-2">
        <div class="card-body p-4">
            <form id="productForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-body mt-4">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="border border-3 border-dark p-4 custom-rounded">
                                <div class="mb-3">
                                    @error('image.*')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <label  for="inputProductDescription" class="form-label">Image | Optional</label>
                                    <input id="image-uploadify" type="file" name="image[]" accept=".xlsx,.xls,image/*,.doc,audio/*,.docx,video/*,.ppt,.pptx,.txt,.pdf" class="form-control" multiple>   
                                    @if($images->isNotEmpty())
                                    @foreach($images as $index => $image)
                                        @if($index === 0)
                                            <img src="{{ asset('storage/' . $image->image) }}" class="card-img-top img-fluid mb-6 mt-4 custom-rounded" alt="{{ $products->name }}">
                                            
                                        @endif
                                    @endforeach
                                    <div class="row mb-3 row-cols-auto g-2 justify-content-center">
                                        @foreach($images as $index => $image)
                                            @if($index !== 0)
                                                <div class="col"><img src="{{ asset('storage/' . $image->image) }}" width="70" class="img-fluid cursor-pointer mt-5" alt=""></div>
                                            @endif
                                        @endforeach
                                    </div>
                                    @else
                                        <img src="{{ asset('assets/image/Icon/noproduct.jpg') }}" class="card-img-top img-fluid custom-rounded" alt="No Photos">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="border border-dark border-2 p-4 custom-rounded">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label for="inputCode" class="form-label">Code</label>
                                        <input type="text" name="code" class="form-control border-dark border-2" id="inputCode" placeholder="#C0D3" value="{{ $products->code }}">
                                    </div>
                                    <div class="col-12">
                                        <label for="inputTitle" class="form-label">Name</label>
                                        <input type="text" name="name" class="form-control border-dark border-2" id="inputProductName" placeholder="Enter Product Name" value="{{ $products->name }}">
                                    </div>
                                    <div class="col-12">
                                        <label for="inputDescription" class="form-label">Description</label>
                                        <textarea class="form-control border-dark border-2" name="description" id="inputProductDescription" rows="3" placeholder="Enter Product Detail">{{ $products->description}}</textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputPrice" class="form-label">Price</label>
                                        <input type="number" name="price" class="form-control border-dark border-2" id="inputPrice" placeholder="00.00" value="{{ $products->price }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputStock" class="form-label">Stock</label>
                                        <input type="number" name="stock" class="form-control border-dark border-2" id="inputStock" placeholder="00.00" value="{{ $products->stock }}">
                                    </div>
                                    <div class="col-12">
                                        <label for="inputCategory" class="form-label">Category</label>
                                        <select class="form-select border-dark border-2" id="inputCategory" name="categoryId">
                                            <option value="{{ $products->category->id }}" selected disabled>{{ $products->category->name }}</option>
                                            @foreach ($category as $item)    
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
            $.ajax({
                url: "{{ route('product.update', encrypt($products->id) ) }}",
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
