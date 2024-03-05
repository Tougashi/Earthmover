@extends('Layouts.index')
@section('content') 

<div class="container-fluid px-md-5">
    <div class="row">
        <!-- Button tambah order -->
        <div class="col text-end">
            <a href="orders/add" class="btn btn-sm btn-dark custom-rounded float-end mb-2 radius-30"><i class='bx bxs-plus-circle'></i> New Orders</a>
        </div>
        <!-- Tabel orders -->
        <div class="card shadow mb-3 custom-rounded">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered border border-dark border-2 rounded " style="width:100%">
                        <thead style="background-color: rgb(19, 16, 16); color:white">
                            <tr>
                                <th>No</th>
                                <th>Code</th>
                                <th>Customer</th>
                                <th>Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-uppercase">#{{ $item->code }}</td>
                                <td>{{ $item->customer->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('l, j F Y') }}</td>
                                <td>
                                    <div class="d-flex order-actions gap-2 justify-content-center">
                                        <a href="#" class="btn btn-primary btn-outline-secondary showOrderBtn" data-code="{{ encrypt($item->code) }}" data-bs-toggle="modal" data-bs-target="#updateModal"><i class='bx bxs-show text-white'></i></a>
                                        <a href="#" class="btn btn-outline-secondary btn-danger text-white deleteProductBtn" data-id="{{ encrypt($item->id) }}"><i class='bx bxs-trash'></i></a>   
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
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-sm ms-auto mx-auto justify-content-center">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6 id="orderCode" class="text-center text-uppercase"></h6>
                <h4 id="customerName" class="text-center"></h4>
                <h6 id="orderDate" class="text-center"></h6>
                <table class="mx-auto table table-bordered table-striped" style="width: 100%;">
                    <thead style="background-color: rgb(19, 16, 16); color:white">
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Product</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody id="orderDetails">

                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3"></td>
                            <td class="text-center"><strong>GRAND TOTAL :</strong></td>
                            <td id="grandTotal" class="text-center"><strong class="text-decoration-underline"></strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="modal-footer">
                <div class="d-flex order-actions gap-2 justify-content-center">
                    {{-- <a href="javascript:(0)" class="btn btn-primary btn-outline-secondary text-white" id="editOrderBtn"><i class='bx bxs-edit'></i> Edit</a> --}}
                    <a href="javascript:(0)" class="btn btn-outline-secondary btn-success text-white" id="printInvoiceBtn"><i class='bx bx-export'></i> Print</a>   
                </div>
            </div>                    
        </div>
    </div>
</div>


@endsection

@push('scripts')

<script>
     $(document).ready(function() {
			var table = $('#example').DataTable( {
				lengthChange: true,
				buttons: [ 'copy', 'excel', 'pdf', 'print']
			} );
            $('.dataTables_filter input').addClass('border border-2 border-dark');
			table.buttons().container()
				.appendTo( '.col-md-6:eq(0)' )
                .addClass('mt-2 justify-content-center mb-2');
		} );

        @if($orders->isNotEmpty())
            $(document).ready(function () {
                $('.deleteProductBtn').click(function (e) {
                    e.preventDefault();
                    var orderId = $(this).data('id');
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
                                url: "{{ route('order.destroy', ':id') }}".replace(':id', orderId),
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

        $(document).ready(function() {
            $('#updateModal').on('shown.bs.modal', function (e) {
                var code = $('#orderCode').text().trim().substring(1); 
                
                $('#editOrderBtn').attr('href', "{{ route('order.edit', ':code') }}".replace(':code', code));
                $('#printInvoiceBtn').attr('href', "{{ route('invoice', ':code') }}".replace(':code', code));
            });

            $('.showOrderBtn').click(function(e) {
                e.preventDefault();
                var code = $(this).data('code');
                $.ajax({
                    url: "{{ Auth::user()->roleId == 1 ? route('getorderAdmin') : route('getorderCashier') }}",
                    type: "GET",
                    data: {
                        code: code
                    },
                    success: function(response) {
                        $('#orderDetails').html(response.orderDetails);
                        $('#grandTotal strong').text("$"+response.grandTotal);
                        $('#orderCode').text("#"+response.orderCode); 
                        $('#customerName').text(response.customerName); 
                        $('#orderDate').text(response.orderDate); 
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                }).done(function() {
                    $('#updateModal').modal('show');
                });
            });
            
            $('#printInvoiceBtn').click(function(e) {
                e.preventDefault();
                var code = $('#orderCode').text().trim().substring(1); 
                var printInvoiceUrl = "{{ route('invoice', ':code') }}".replace(':code', code);
                window.open(printInvoiceUrl, '_blank'); 
            });
            
            $('#updateModal').on('hidden.bs.modal', function (e) {
                $('#orderDetails').empty(); 
                $('#grandTotal strong').text(""); 
                $('#orderCode').text(""); 
                $('#customerName').text(""); 
                $('#orderDate').text("");
            });
        });


</script>

@endpush