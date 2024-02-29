@extends('Layouts.index')
@section('content') 
<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <div class="card shadow custom-rounded">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="{{ asset('assets/image/Icon/profile-icon.jpg') }}" alt="Admin" class="rounded-circle p-1 bg-dark" width="110">
                        <div class="mt-3">
                            <h4>{{ auth()->user()->username }}</h4>
                            <p class="text-secondary mb-1">{{ auth()->user()->email }}</p>
                            <p class="badge
                                @if (auth()->user()->role && auth()->user()->role->role === 'Admin') bg-primary
                                @elseif (auth()->user()->role && auth()->user()->role->role === 'Cashier') bg-success
                                @elseif (auth()->user()->role && auth()->user()->role->role === 'Customer') bg-secondary
                                @endif
                                text-uppercase fs-7">{{ auth()->user()->role->role }}</p>
                            <div class="mt-3"> 
                                <a href="#edit{{ encrypt(auth()->user()->id) }}" class="btn btn-outline-secondary btn-dark editUserBtn text-white" data-id="{{ encrypt(auth()->user()->id) }}" data-role="{{ auth()->user()->role->id }}" data-bs-toggle="modal" data-bs-target="#editRoleModal">
                                    <i class="bx bx-edit"></i> Edit
                                </a>  
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

$(document).ready(function () {
            $('#submitBtn').click(function (e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('user.update', encrypt(auth()->user()->id) ) }}",
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



</script>


@endpush
@endsection
