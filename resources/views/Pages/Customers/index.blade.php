@extends('Layouts.index')
@section('content') 

<div class="container-fluid px-md-5">
    <div class="row">
        <div class="col text-end">
            <a href="{{ url()->current() }}/add" class="btn btn-sm btn-dark custom-rounded float-end mb-2 radius-30"><i class='bx bxs-plus-circle'></i> New Customer</a>
        </div>
        <div class="card shadow mb-3 custom-rounded">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered border border-dark border-2 rounded " style="width:100%">
                        <thead style="background-color: rgb(19, 16, 16); color:white">
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Address</th> 
                                <th>Contact</th> 
                                <th>Email</th> 
                                <th>Created</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td> 
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->address }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->contact }}</td>
                                <td>{{ $item->created_at->formatLocalized('%d %B %Y') }}</td>
                                <td>
                                    <div class="d-flex order-actions gap-2 justify-content-center">
                                        <a href="#" class="btn btn-outline-secondary btn-primary editUserBtn text-white" data-id="{{ encrypt($item->id) }}" data-name="{{ $item->name }}" data-address="{{ $item->address }}" data-contact="{{ $item->contact }}" data-email="{{ $item->email }}" data-bs-toggle="modal" data-bs-target="#updateModal">
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
                    <h5 class="modal-title" id="editRoleModalLabel">Edit Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-body mt-4">
                        <div class="border border-dark border-3 p-4 custom-rounded">
                            <div class="row g-3">
                                <input type="hidden" name="id" id="inputProductid">
                                <div class="col-12">
                                    <label for="inputTitle" class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control border-dark border-2" id="inputCustomerName" placeholder="" required>
                                </div>
                                <div class="col-12">
                                    <label for="inputTitle" class="form-label">Contact</label>
                                    <input type="text" name="contact" class="form-control border-dark border-2" id="inputCustomerContact" placeholder="" required>
                                </div>
                                <div class="col-12">
                                    <label for="inputTitle" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control border-dark border-2" id="inputCustomerEmail" placeholder="" required>
                                </div>
                                <div class="col-12">
                                    <label for="inputDescription" class="form-label">Address</label>
                                    <textarea class="form-control border-dark border-2" name="address" id="inputCustomerAddress" rows="3" placeholder="" required></textarea>
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
	});

    @if($customers->isNotEmpty())
    $(document).ready(function () {
            $('.editUserBtn').click(function () {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var contact = $(this).data('contact');
                var email = $(this).data('email');
                var address = $(this).data('address');

                $('#inputProductid').val(id); 
                $('#inputCustomerName').val(name);
                $('#inputCustomerContact').val(contact);
                $('#inputCustomerEmail').val(email);    
                $('#inputCustomerAddress').val(address);
            });
        });

        $('#submitUpdateBtn').click(function (e) {
            e.preventDefault();
            var customerId = $('#inputProductid').val(); 
            $.ajax({
                url: "{{ route('customer.update', ':id') }}".replace(':id', customerId),
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
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
        

        $(document).ready(function () {
            $('.deleteProductBtn').click(function (e) {
                e.preventDefault();
                var customerId = $(this).data('id');
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
                            url: "{{ route('customer.destroy', ':id') }}".replace(':id', customerId),
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

@endsection
