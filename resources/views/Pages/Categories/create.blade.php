@extends('Layouts.index')
@section('content') 
<div class="container-fluid mb-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow custom-rounded mb-4">
                <div class="card-body p-4">
                    <form id="categoryForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-body mt-4">
                            <div class="border border-dark border-3 p-4 custom-rounded">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label for="inputTitle" class="form-label">Name</label>
                                        <input type="text" name="name" class="form-control border-dark border-2" id="inputProductName" placeholder="Enter Category Name" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="inputDescription" class="form-label">Description</label>
                                        <textarea class="form-control border-dark border-2" name="description" id="inputProductDescription" rows="3" placeholder="Enter Category Detail" required></textarea>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button type="button" id="submitBtn" class="btn btn-dark custom-rounded">Save Product</button>
                                        </div>
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

@push('scripts')

<script>
    $(document).ready(function () {
        $('#submitBtn').click(function (e) {
            e.preventDefault();

            let productName = $('#inputProductName').val().trim();
            let productDescription = $('#inputProductDescription').val().trim();

            if (!productName || !productDescription) {
                Swal.fire({
                    title: 'Warning',
                    text: 'Please fill in all required fields',
                    icon: 'warning',
                    confirmButtonText: 'OK',
                    allowOutsideClick: false
                });
                return;
            }

            $.ajax({
                url: "{{ route('categories.add') }}",
                type: "POST",
                data: new FormData($('#categoryForm')[0]),
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
                    $('#categoryForm')[0].reset();
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