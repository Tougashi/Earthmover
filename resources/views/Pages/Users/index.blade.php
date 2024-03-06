@extends('Layouts.index')
@section('content')
<div class="container-fluid px-md-5">
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-3 custom-rounded">
                <div class="card-body">
                    <div class="row align-items-center">
                        <form class="">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="position-relative">
                                        <input type="text" class="form-control ps-5 search-input border-dark border custom-rounded" id="searchInput" placeholder="Search User..."> 
                                        <span class="position-absolute product-show translate-middle-y"><i class="bx bx-search"></i></span>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="btn-group float-end" role="group" aria-label="Button group with nested dropdown">
                                        <button type="button" class="btn btn-white">Sort By</button>
                                        <div class="btn-group" role="group">
                                            <button id="sortByDropdown" type="button" class="btn btn-white dropdown-toggle dropdown-toggle-nocaret px-1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class='bx bx-slider'></i>
                                            </button>
                                            <ul class="dropdown-menu custom-rounded cursor-pointer" aria-labelledby="sortByDropdown">
                                                <li><p class="dropdown-item sort-item" data-sort="">All</p></li>
                                                <li><p class="dropdown-item sort-item" data-sort="admin">Admin</p></li>
                                                <li><p class="dropdown-item sort-item" data-sort="cashier">Cashier</p></li>
                                                <li><p class="dropdown-item sort-item" data-sort="customer">Customer</p></li>
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
    
    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-3 row-cols-xxl-4 product-grid">
        @foreach ($users as $item)
        <div class="col product-card">
            <div class="card mb-3 shadow custom-rounded">
                <div class="card-body text-center">
                    <div class="p-6 custom-rounded radius-15">
                        @php
                        $profileImage = $item->image ? asset('storage/' . $item->image) : asset('assets/image/Icon/profile-icon.jpg');
                        @endphp
                        <img src="{{ $profileImage }}" alt="profileImg" class="img-fluid rounded-circle bg-dark p-1" width="110" />
                        <p class="mb-2 mt-5 fw-bold product-title">{{ $item->email }}</p>
                        <p class="mb-3 product-title">{{ $item->username }}</p>
                        <p class="mb-3 small-font text-muted">Created : {{ $item->created_at->formatLocalized('%d %B %Y') }}</p>
                        <p class="mb-3 badge product-type
                            @if ($item->role && $item->role->role === 'Admin') bg-primary
                            @elseif ($item->role && $item->role->role === 'Cashier') bg-success
                            @elseif ($item->role && $item->role->role === 'Customer') bg-secondary
                            @endif
                            text-uppercase fs-7">{{ $item->role->role }}</p>
                        <div class="d-flex align-items-center mt-3 fs-6">
                            <a href="{{ route('role.update', encrypt($item->id) ) }}" class="btn btn-outline-secondary btn-primary text-white editUserBtn" data-id="{{ encrypt($item->id) }}" data-role="{{ $item->role->id }}" data-bs-toggle="modal" data-bs-target="#editRoleModal">
                                <i class="bx bx-edit"></i>
                            </a>
                            <div class="mb-0 ms-auto">                                                                                    
                                <a href="{{ route('user.destroy', encrypt($item->id) ) }}" class="btn btn-outline-secondary btn-danger text-white deleteUserBtn" data-id="{{ encrypt($item->id) }}"><i class="bx bx-trash"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <!-- Modal -->
   <form id="userForm" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
        <div class="modal fade" id="editRoleModal" tabindex="1" aria-labelledby="editRoleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-sm ms-auto custom-rounded">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editRoleModalLabel">Edit Role</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="newRole" class="form-label">Role</label>
                            <select class="form-select border-dark border-2" id="roleId" name="roleId">
                                <option selected disabled>Select Role</option>
                                @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->role }}</option>
                                @endforeach
                            </select>                                
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="submitBtn" class="btn btn-dark custom-rounded">Save Changes</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div id="noProductMessage" class="row justify-content-center d-none">
        <h2 class="text-center">User does not exist</h2>
    </div>
    
</div>


@push('scripts')
    <script>
        // Filter
        document.addEventListener('DOMContentLoaded', function() {
            const sortItems = document.querySelectorAll('.sort-item');
            const noProductMessage = document.getElementById('noProductMessage');

            sortItems.forEach(item => {
                item.addEventListener('click', function() {
                    const sortFilter = this.dataset.sort;
                    const categoryFilter = getCurrentCategoryFilter();
                    filterProducts(sortFilter, categoryFilter);
                });
            });

            function filterProducts(sortFilter, categoryFilter) {
                const products = document.querySelectorAll('.product-card');
                let hasProduct = false;

                products.forEach(product => {
                    const type = product.querySelector('.product-type').innerText.trim();

                    const isTypeMatched = sortFilter === '' || type.toLowerCase() === sortFilter.toLowerCase();
                    
                    if (isTypeMatched) {
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

        @if($users->isNotEmpty())
        $(document).ready(function () {
            $('.deleteUserBtn').click(function (e) {
                e.preventDefault();
                var UserId = $(this).data('id');
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
                            url: "{{ route('user.destroy', ':id') }}".replace(':id', UserId),
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

        $(document).ready(function () {
            $('#submitBtn').click(function (e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('role.update', encrypt($item->id) ) }}",
                    type: "POST",
                    data: new FormData($('#userForm')[0]),
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
                        loadUsers(); 
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });

    @endif 
    </script>
@endpush

@endsection 
