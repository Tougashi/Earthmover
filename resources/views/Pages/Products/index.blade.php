@extends('Layouts.index')
@section('content')
<div class="container-fluid px-md-5">
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-3 custom-rounded">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-lg-2 col-xl-2">
                            @if(auth()->check() && auth()->user()->roleId === 1)
                            <a href="{{ url()->current(). '/add' }}" class="btn btn-dark custom-rounded"><i class='bx bxs-plus-circle'></i> New Product</a>
                            @endif
                        </div> 
                        <div class="col-lg-9 col-xl-10 @if(auth()->check() && auth()->user()->roleId === 2) align-items-center @endif">
                          <form class="@if(auth()->check() && auth()->user()->roleId === 1) float-lg-end @endif">
                              <div class="row row-cols-lg-auto g-2">
                                  <div class="col-lg">
                                      <div class="position-relative">
                                          <input type="text" class="form-control ps-5 search-inpu border-dark border custom-rounded" id="searchInput" placeholder="Search Product..."> 
                                          <span class="position-absolute product-show translate-middle-y"><i class="bx bx-search"></i></span>
                                      </div>
                                  </div>
                                  <div class="col-12">
                                    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                        <button type="button" class="btn btn-white">Sort By</button>
                                        <div class="btn-group" role="group">
                                            <button id="sortByDropdown" type="button" class="btn btn-white dropdown-toggle dropdown-toggle-nocaret px-1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class='bx bx-slider'></i>
                                            </button>
                                            <ul class="dropdown-menu custom-rounded cursor-pointer" aria-labelledby="sortByDropdown">
                                                <li><p class="dropdown-item sort-item" data-sort="">All</p></li>
                                                <li><p class="dropdown-item sort-item" data-sort="male">Male</p></li>
                                                <li><p class="dropdown-item sort-item" data-sort="female">Female</p></li>
                                                <li><p class="dropdown-item sort-item" data-sort="unisex">Unisex</p></li>
                                            </ul>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-12">
                                      <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                          <button type="button" class="btn btn-white">Type</button>
                                          <div class="btn-group" role="group">
                                              <button id="typeDropdown" type="button" class="btn btn-white dropdown-toggle dropdown-toggle-nocaret px-1" data-bs-toggle="dropdown" aria-expanded="false">
                                                  <i class='bx bxs-category'></i>
                                              </button>
                                              <ul class="dropdown-menu custom-rounded cursor-pointer" aria-labelledby="typeDropdown">
                                                  <li><p class="dropdown-item category-item category-all" data-category="">All</p></li>
                                                  @foreach ($categories as $category)
                                                  <li><p class="dropdown-item category-item" data-category="{{ $category->name }}">{{ $category->name }}</p></li>
                                                  @endforeach
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
    
    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-5 product-grid" id="productContainer">
      @foreach ($products as $product)
        <div class="col product-card text-center">
          <a href="{{ url()->current() . '/'. encrypt($product->id) }}" class="text-dark text-decoration-none">
            <div class="card custom-rounded shadow cursor-pointer mb-4">
              @if(!empty($images[$product->id]) && $images[$product->id]->isNotEmpty())
                  <img src="{{ asset('storage/' . $images[$product->id]->first()->image) }}" class="card-img-top img-fluid custom-rounded" height="70" width="auto" alt="{{ $product->name }}">
              @else
                  <img src="{{ asset('assets/image/Icon/noproduct.jpg') }}" class="card-img-top img-fluid custom-rounded" height="70" width="auto"  alt="{{ $product->name }}">
              @endif
              <div class="card-body product">
                <h6 class="card-title product-title">{{ $product->name }}</h6>
                <p class="card-text mb-0 mt-0 product-type">{{ $product->type }}</p>
                <p class="card-text product-category">{{ $product->category->name }}</p>
                <div class="clearfix">
                  <p class="mb-0 float-start"><strong>{{ $product->stock }}</strong> Stock</p>
                  <p class="mb-0 float-end fw-bold">
                    <span class="me-2 text-decoration-line-through text-secondary"></span>
                    <span>$ {{ $product->price }}</span>
                  </p>
                </div>
                @if(auth()->check() && auth()->user()->roleId === 1)
                <div class="d-flex align-items-center mt-3 fs-6">
                    <div class="cursor-pointer">
                        <a href="{{ route('product.edit', encrypt($product->id)) }}" class="btn btn-outline-secondary btn-dark text-white">
                            <i class='bx bxs-edit'></i>
                        </a>
                    </div>                        
                    <p class="mb-0 ms-auto">
                        <a href="{{ route('product.destroy', encrypt($product->id)) }}" class="btn btn-outline-secondary btn-dark text-white deleteProductBtn" data-id="{{ encrypt($product->id) }}">
                            <i class='bx bxs-trash'></i>
                        </a>                                               
                    </p>
                </div>
                @else
                <div class="d-flex align-items-center mt-3 fs-6">
                  <div class="cursor-pointer">
                    <i class='bx bxs-star text-warning'></i>
                    <i class='bx bxs-star text-warning'></i>
                    <i class='bx bxs-star text-warning'></i>
                    <i class='bx bxs-star text-warning'></i>
                    <i class='bx bxs-star text-secondary'></i>
                  </div>    
                  <p class="mb-0 ms-auto">haha</p>
                </div>
                @endif
              </div>
            </div>
          </a>
        </div>
      @endforeach
    </div>

    <div id="noProductMessage" class="row justify-content-center d-none">
        <h2 class="text-center">Product does not exist</h2>
    </div>
    
</div>

@endsection

@push('scripts')
<script>
    
    // Filter
    document.addEventListener('DOMContentLoaded', function() {
        const sortItems = document.querySelectorAll('.sort-item');
        const categoryItems = document.querySelectorAll('.category-item');
        const noProductMessage = document.getElementById('noProductMessage');

        sortItems.forEach(item => {
            item.addEventListener('click', function() {
                const sortFilter = this.dataset.sort;
                const categoryFilter = getCurrentCategoryFilter();
                filterProducts(sortFilter, categoryFilter);
            });
        });

        categoryItems.forEach(item => {
            item.addEventListener('click', function() {
                const categoryFilter = this.dataset.category;
                const sortFilter = getCurrentSortFilter();
                filterProducts(sortFilter, categoryFilter);
            });
        });

        function filterProducts(sortFilter, categoryFilter) {
            const products = document.querySelectorAll('.product-card');
            let hasProduct = false;

            products.forEach(product => {
                const type = product.querySelector('.product-type').innerText.trim();
                const category = product.querySelector('.product-category').innerText.trim();

                const isTypeMatched = sortFilter === '' || type.toLowerCase() === sortFilter.toLowerCase();
                const isCategoryMatched = categoryFilter === '' || category.toLowerCase() === categoryFilter.toLowerCase();
                
                if (isTypeMatched && isCategoryMatched) {
                    product.style.display = 'block';
                    hasProduct = true;
                } else {
                    product.style.display = 'none';
                }
            });

            if (!hasProduct) {
                noProductMessage.classList.remove('d-none');
            } else {
                noProductMessage.classList.add('d-none');
            }
        }

        function getCurrentSortFilter() {
            const activeSortItem = document.querySelector('.sort-item.active');
            return activeSortItem ? activeSortItem.dataset.sort : '';
        }

        function getCurrentCategoryFilter() {
            const activeCategoryItem = document.querySelector('.category-item.active');
            return activeCategoryItem ? activeCategoryItem.dataset.category : '';
        }
    });


    //DELETE FOR ADMIN
    @if($products->isNotEmpty())
        $(document).ready(function () {
            $('.deleteProductBtn').click(function (e) {
                e.preventDefault();
                var productId = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('product.destroy', ':id') }}".replace(':id', productId),
                            type: "get",
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
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
                            },
                            error: function (xhr, status, error) {
                                console.error(xhr.responseText);
                            }
                        });
                    }
                });
            });
        });
    @endif 


</script>
@endpush
