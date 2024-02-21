@extends('Layouts.index')
@section('content') 
<div class="container-fluid px-md-5">
    <div class="card custom-rounded">
        <div class="card-body p-4">
            <form action="{{ route('products.add') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-body mt-4">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="border border-3 border-dark p-4 custom-rounded">
                                <div class="mb-3">
                                    <label for="inputTitle" class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control border-dark border-2" id="inputProductName" placeholder="Enter Product Name">
                                </div>
                                <div class="mb-3">
                                    <label for="inputDescription" class="form-label">Description</label>
                                    <textarea class="form-control border-dark border-2" name="description" id="inputProductDescription" rows="3" placeholder="Enter Product Detail"></textarea>
                                </div>
                                <div class="mb-3">
                                    @error('image.*')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <label  for="inputProductDescription" class="form-label">Image</label>
                                    <input id="image-uploadify" type="file" name="image[]" accept=".xlsx,.xls,image/*,.doc,audio/*,.docx,video/*,.ppt,.pptx,.txt,.pdf" class="form-control" multiple required>   
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="border border-dark border-2 p-4 custom-rounded">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label for="inputCode" class="form-label">Code</label>
                                        <input type="text" name="code" class="form-control border-dark border-2" id="inputCostPerPrice" placeholder="#C0D3">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputPrice" class="form-label">Price</label>
                                        <input type="number" name="price" class="form-control border-dark border-2" id="inputPrice" placeholder="00.00">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputStock" class="form-label">Stock</label>
                                        <input type="number" name="stock" class="form-control border-dark border-2" id="inputCostPerPrice" placeholder="00.00">
                                    </div>
                                    <div class="col-12">
                                        <label for="inputCategory" class="form-label">Category</label>
                                        <select class="form-select border-dark border-2" id="inputProductType" name="categoryId">
                                            <option selected disabled>Choose...</option>
                                            @foreach ($category as $item)    
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label for="inputType" class="form-label">Type</label>
                                        <select class="form-select border-dark border-2" id="inputVendor" name="type">
                                            <option selected disabled>Choose...</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="unisex">Unisex</option>
                                        </select>
                                    </div>
                                    
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-dark custom-rounded">Save Product</button>
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
</script>
@endpush
@endsection
