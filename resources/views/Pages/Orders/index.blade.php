@extends('Layouts.index')
@section('content') 

<div class="container-fluid px-md-5">
    <div class="row">
        <div class="col text-end">
            <a href="{{ url()->current() }}/add" class="btn btn-sm btn-dark custom-rounded float-end mb-2 radius-30"><i class='bx bxs-plus-circle'></i> New Orders</a>
        </div>
        <div class="card shadow mb-3 custom-rounded">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped border border-dark border-2 rounded " style="width:100%">
                        <thead style="background-color: rgb(19, 16, 16); color:white">
                            <tr>
                                <th>No</th>
                                <th>Code</th>
                                <th>Product</th>
                                <th>Quantity</th> 
                                <th>Price</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order as $item )
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->code }}</td>
                                <td>{{ $item->product->name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->totalPrice }}</td>
                                <td>{{ $item->transaction->status }}</td>
                                <td>{{ $item->created_at->formatLocalized('%d %B %Y') }}</td>
                                <td></td>
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
