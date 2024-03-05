@extends('Layouts.index')
@section('content') 

<div class="container-fluid px-md-5">
    <div class="row">
        <div class="col text-end">
            <a href="{{ url()->current() }}/add" class="btn btn-sm btn-dark custom-rounded float-end mb-2 radius-30"><i class='bx bxs-plus-circle'></i> New Category</a>
        </div>
        <div class="card shadow mb-3 custom-rounded">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered border border-dark border-2 rounded " style="width:100%">
                        <thead style="background-color: rgb(19, 16, 16); color:white">
                            <tr>
                                <th>No</th>
                                <th>Category</th>
                                <th>Description</th> 
                                <th>Created At</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->description }}</td>
                                <td>{{ $item->created_at->formatLocalized('%d %B %Y') }}</td>
                                <td>
                                    <div class="d-flex order-actions gap-2 justify-content-center">
                                        <a href="#" class="btn btn-outline-secondary btn-primary editUserBtn text-white" data-id="{{ encrypt($item->id) }}" data-name="{{ $item->name }}" data-description="{{ $item->description }}" data-bs-toggle="modal" data-bs-target="#updateModal">
                                            <i class="bx bx-edit"></i>
                                        </a>                                         
                                        <a href="javascript:(void);" class="btn btn-outline-secondary btn-danger text-white deleteProductBtn" data-id="{{ encrypt($item->id) }}">
                                            <i class='bx bxs-trash'></i>
                                        </a>      
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>   
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
                    <h5 class="modal-title" id="editRoleModalLabel">Edit Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-body mt-4">
                        <div class="border border-dark border-3 p-4 custom-rounded">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="inputTitle" class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control border-dark border-2" id="inputProductName" placeholder="Enter Product Name"  required>
                                </div>
                                <div class="col-12">
                                    <label for="inputDescription" class="form-label">Description</label>
                                    <textarea class="form-control border-dark border-2" name="description" id="inputProductDescription" rows="3" placeholder="Enter Product Detail"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="submitUpdateBtn" class="btn btn-dark custom-rounded">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
</form>

@push('scripts')

<script>
    $(document).ready(function() {
			let table = $('#example').DataTable( {
			} );
            $('.dataTables_filter input').addClass('border border-2 border-dark');
		} );
    
    @if($categories->isNotEmpty())
        $(document).ready(function () {
            $('.deleteProductBtn').click(function (e) {
                e.preventDefault();
                var categoryId = $(this).data('id');
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
                            url: "{{ route('category.destroy', ':id') }}".replace(':id', categoryId),
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
        $(document).ready(function() {
            $('.editUserBtn').click(function() {
                var name = $(this).data('name');
                var description = $(this).data('description');
                
                $('#inputProductName').val(name);
                $('#inputProductDescription').val(description);
            });
        });

        $('#submitUpdateBtn').click(function (e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('category.update', ':id') }}".replace(':id', '{{ $item->id }}'),
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

    @endif 

        
</script>
    
@endpush

@endsection
