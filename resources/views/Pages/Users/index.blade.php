@extends('Layouts.index')
@section('content')

<div class="container-fluid px-md-5">
    <div class="row">
        <div class="col-12">
            <div class="card mb-3 custom-rounded">
                <div class="card-body">
                    <div class="border border-2 border-dark custom-rounded p-4">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead style="background-color: rgb(19, 16, 16); color:white">
                                    <tr>
                                        <th>No</th>
                                        <th>Email</th>
                                        <th>Username</th>
                                        <th>Role</th>
                                        <th>Created At</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->username }}</td>
                                        <td>
                                            <div class="badge
                                                @if ($item->role && $item->role->role === 'Admin') bg-primary
                                                @elseif ($item->role && $item->role->role === 'Cashier') bg-success
                                                @elseif ($item->role && $item->role->role === 'Customers') bg-secondary
                                                @endif
                                                text-uppercase fs-7">
                                                {{-- @if ($item->role && $item->role->role === 'Admin') <i class='bx bx-badge-check me-1'></i>
                                                @elseif ($item->role && $item->role->role === 'Cashier')<i class='bx bx-dollar-circle me-1'></i>
                                                @elseif ($item->role && $item->role->role === 'Customers')<i class='bx bx-user me-1'></i>
                                                @endif --}}
                                                {{ $item->role->role }}
                                            </div>
                                        </td>
                                        <td>{{ $item->created_at->formatLocalized('%d %B %Y')  }}</td>
                                        <td>
                                            <div class="d-flex order-actions gap-2">
                                                <a href="" class="btn btn-dark custom-hover">
                                                    <i class='bx bxs-edit'></i>
                                                </a>
                                                <a href="" class="btn btn-dark custom-hover deleteProductBtn">
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
    </div>
</div>

@push('scripts')
    <script>
       $(document).ready(function() {
			var table = $('#example').DataTable( {
				lengthChange: true,
				// buttons: [ 'copy', 'excel', 'pdf', 'print']
			} );
		 
			// table.buttons().container()
			// 	.appendTo( '#example_wrapper .col-md-6:eq(0)' );
		} );
    </script>
@endpush

@endsection 
