@extends('Layouts.index')
@section('content') 

<div class="container-fluid px-md-5">
    <div class="row">
        <div class="col text-end">
            <a href="orders/add" class="btn btn-sm btn-dark custom-rounded float-end mb-2 radius-30"><i class='bx bxs-plus-circle'></i> New Orders</a>
        </div>
        <div class="card shadow mb-3 custom-rounded">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered border border-dark border-2 rounded " style="width:100%">
                        <thead style="background-color: rgb(19, 16, 16); color:white">
                            <tr>
                                <th>No</th>
                                <th>Code</th>
                                <th>Customer</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($groupedOrders as $code => $orders)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $code }}</td>
                                <td>{{ $orders->first()->customer->name }}</td>
                                <td>Pending</td>
                                <td>{{ $orders->first()->created_at->formatLocalized('%d %B %Y') }}</td>
                                <td>
                                    <div class="d-flex order-actions gap-2 justify-content-center">
                                        <a href="" class="btn btn-primary btn-outline-secondary"><i class='bx bxs-show text-white'></i></a>
                                        <a href="" class="btn btn-danger btn-outline-secondary"><i class='bx bxs-trash text-white'></i></a>
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
        
</script>
    
@endpush

@endsection
