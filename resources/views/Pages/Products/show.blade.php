@extends('Layouts.index')
@section('content')
<x-back/>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border mb-4 custom-rounded">
                <div class="row g-0">
                    <div class="col-md-4 border-end">
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
                    <div class="col-md-8 mt-4 text-start">
                        <div class="card-body">
                            <h4 class="card-title text-start">{{ $products->name }}</h4>
                            <div class="d-flex gap-3 py-3">
                                <div class="cursor-pointer">
                                    <i class='bx bxs-star text-warning'></i>
                                    <i class='bx bxs-star text-warning'></i>
                                    <i class='bx bxs-star text-warning'></i>
                                    <i class='bx bxs-star text-warning'></i>
                                    <i class='bx bxs-star text-secondary'></i>
                                </div>    
                                <div>142 reviews</div>
                                <div class="text-success"><i class='bx bxs-cart-alt align-middle'></i> 134 orders</div>
                            </div>
                            <div class="mb-3"> 
                                <span class="price h4">$ {{ $products->price }}</span> 
                            </div>
                            <dl class="row">
                                <dt class="col-sm-4">Description :</dt>
                                <dd class="col-sm-5">{{ $products->description }}</dd>
                                <dt class="col-sm-4">Model / Code :</dt>
                                <dd class="col-sm-5">{{ $products->code }}</dd>
                                <dt class="col-sm-4">Color :</dt>
                                <dd class="col-sm-5">Brown</dd>
                                <dt class="col-sm-4">Delivery :</dt>
                                <dd class="col-sm-5">World Wide</dd>
                            </dl>
                            <hr>
                            <div class="row row-cols-auto row-cols-1 row-cols-md-3 align-items-center">
                                <div class="col">
                                    <label class="form-label">Quantity</label>
                                    <div class="input-group input-spinner">
                                        <button class="btn btn-white" type="button" id="button-plus"> + </button>
                                        <input type="number" class="form-control" value="1" id="quantity">
                                        <button class="btn btn-white" type="button" id="button-minus"> − </button>
                                    </div>
                                </div>
                                <div class="col">
                                    <label class="form-label">Select size</label>
                                    <div class="">
                                        <label class="form-check form-check-inline">
                                            <input type="radio"class="form-check-input"  name="select_size" checked="" class="custom-control-input">
                                            <div class="form-check-label">Small</div>
                                        </label>
                                        <label class="form-check form-check-inline">
                                            <input type="radio"class="form-check-input"  name="select_size" checked="" class="custom-control-input">
                                            <div class="form-check-label">Medium</div>
                                        </label>
                                        <label class="form-check form-check-inline">
                                            <input type="radio"class="form-check-input"  name="select_size" checked="" class="custom-control-input">
                                            <div class="form-check-label">Large</div>
                                        </label>
                                    </div>
                                </div> 
                            </div>
                            <div class="gap-3 mt-3">
                                <a href="#" class="btn btn-dark btn-sm">Buy Now</a>
                                <a href="#" class="btn btn-outline-dark btn-sm"><span class="">Add to cart</span> <i class='bx bxs-cart-alt'></i></a>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
    const buttonPlus = document.getElementById('button-plus');
    const buttonMinus = document.getElementById('button-minus');
    const quantityInput = document.getElementById('quantity');
    buttonPlus.addEventListener('click', function() {
        quantityInput.value = parseInt(quantityInput.value) + 1;
    });
    buttonMinus.addEventListener('click', function() {
        if (parseInt(quantityInput.value) > 1) {
            quantityInput.value = parseInt(quantityInput.value) - 1;
        }
    });
    </script>
@endpush


@endsection 
