@extends('Layouts.index')
@section('content') 
<div class="container-fluid mt-5">
    <div class="row justify-content-center"> 
        <div class="col-lg-6"> 
            <div class="card shadow custom-rounded text-center" style="margin-left: -50px !important;">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center">
                        @php
                        $user = auth()->user();
                        $profileImage = $user->image ? asset('storage/' . $user->image) : asset('assets/image/Icon/profile-icon.jpg');
                        @endphp
                        <img src="{{ $profileImage }}" alt="profileImg" class="img-fluid rounded-circle bg-dark p-1" width="110" />
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
                                <a href="" class="btn btn-outline-secondary btn-dark editUserBtn text-white" data-id="{{ encrypt(auth()->user()->id) }}" data-role="{{ auth()->user()->role->id }}" data-bs-toggle="modal" data-bs-target="#updateModal">
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


<!-- Modal -->
<form id="userForm" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-sm ms-auto mx-auto justify-content-center">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editRoleModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-body mt-4">
                        <div class="row">
                            <div class="col-lg-12"> 
                                <div class="border border-dark border-2 p-4 custom-rounded">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label for="inputEmail" class="form-label">Email</label>
                                            <input type="text" name="email" class="form-control border-dark border-2" id="inputEmail" value="{{ auth()->user()->email }}">
                                        </div>
                                        <div class="col-12">
                                            <label for="inputUsername" class="form-label">Username</label>
                                            <input type="text" name="username" class="form-control border-dark border-2" id="inputUsername" value="{{ auth()->user()->username }}">
                                        </div>
                                        <div class="col-12">
                                            @error('image.*')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <label  for="inputImage" class="form-label">Image Profile</label>
                                            <input id="inputImage" type="file" name="image" class="form-control border-dark border-2">   
                                        </div>
                                        <div class="col-12 mt-3">
                                            <label for="imagePreview" class="form-label">Image Preview</label>
                                            <img id="imagePreview" src="#" alt="Image Preview" style="max-width: 100%; height: auto; display: none;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>         
                </div>
                <div class="modal-footer">
                    <button type="button" id="submitBtn" class="btn btn-dark custom-rounded">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
</form>
  


@push('scripts')

<script>
    document.getElementById('inputImage').onchange = function (event) {
        var input = event.target;
        var reader = new FileReader();

        reader.onload = function () {
            var img = document.getElementById('imagePreview');
            img.src = reader.result;
            img.style.display = 'block';
        };

        reader.readAsDataURL(input.files[0]);
    };

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
