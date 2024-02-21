@extends('Layouts.index')
@section('content')

<div class="container-fluid px-md-5">
    <div class="row">
        <div class="col-12">
            <div class="card mb-3 custom-rounded">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-lg-3 col-xl-2">
                            @if(auth()->check() && auth()->user()->roleId === 1)
                            <a href="{{ url()->current(). '/add' }}" class="btn btn-dark mb-2"><i class='bx bxs-plus-circle'></i> New Product</a>
                            @endif
                        </div> 
                        <div class="col-lg-9 col-xl-10 @if(auth()->check() && auth()->user()->roleId === 2) align-items-center @endif">
                            <form class=" @if(auth()->check() && auth()->user()->roleId === 1) float-lg-end  @endif">
                                <div class="row row-cols-lg-auto g-2">
                                    <div class="col-lg">
                                        <div class="position-relative">
                                            <input type="text" class="form-control ps-5" placeholder="Search Product..."> <span class="position-absolute product-show translate-middle-y"><i class="bx bx-search"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                            <button type="button" class="btn btn-white">Sort By</button>
                                            <div class="btn-group" role="group">
                                              <button id="btnGroupDrop1" type="button" class="btn btn-white dropdown-toggle dropdown-toggle-nocaret px-1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class='bx bx-chevron-down'></i>
                                              </button>
                                              <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                <li><a class="dropdown-item" href="#">Dropdown link</a></li>
                                                <li><a class="dropdown-item" href="#">Dropdown link</a></li>
                                              </ul>
                                            </div>
                                          </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                            <button type="button" class="btn btn-white">Collection Type</button>
                                            <div class="btn-group" role="group">
                                              <button id="btnGroupDrop1" type="button" class="btn btn-white dropdown-toggle dropdown-toggle-nocaret px-1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class='bx bxs-category'></i>
                                              </button>
                                              <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                <li><a class="dropdown-item" href="#">Dropdown link</a></li>
                                                <li><a class="dropdown-item" href="#">Dropdown link</a></li>
                                              </ul>
                                            </div>
                                          </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-white">Price Range</button>
                                            <div class="btn-group" role="group">
                                              <button id="btnGroupDrop1" type="button" class="btn btn-white dropdown-toggle dropdown-toggle-nocaret px-1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class='bx bx-slider'></i>
                                              </button>
                                              <ul class="dropdown-menu dropdown-menu-start" aria-labelledby="btnGroupDrop1">
                                                <li><a class="dropdown-item" href="#">Dropdown link</a></li>
                                                <li><a class="dropdown-item" href="#">Dropdown link</a></li>
                                              </ul>
                                            </div>
                                          </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-5 product-grid">
      @foreach ($product as $item)
      <div class="col">
          <div class="card custom-rounded cursor-pointer">
            @if($images->isNotEmpty())
            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="...">
            @else
                <img src="{{ asset('assets/image/Icon/noproduct.jpg') }}" class="card-img-top" alt="...">
            @endif
        
              <div class="card-body">
                  <h6 class="card-title">{{ $item->name }}</h6>
                  <h6 class="card-title">{{ $item->category->name }}</h6>
                  <div class="clearfix">
                      <p class="mb-0 float-start"><strong>{{ $item->stock }}</strong> Stock</p>
                      <p class="mb-0 float-end fw-bold">
                          <span class="me-2 text-decoration-line-through text-secondary"></span>
                          <span>$ {{ $item->price }}</span>
                      </p>
                  </div>
                  <div class="d-flex align-items-center mt-3 fs-6">
                      <div class="cursor-pointer">
                          <i class='bx bxs-star text-warning'></i>
                          <i class='bx bxs-star text-warning'></i>
                          <i class='bx bxs-star text-warning'></i>
                          <i class='bx bxs-star text-warning'></i>
                          <i class='bx bxs-star text-secondary'></i>
                      </div>	
                      <p class="mb-0 ms-auto">4.2(182)</p>
                  </div>
              </div>
          </div>
      </div>
      @endforeach
  </div>
  

</div>
@endsection