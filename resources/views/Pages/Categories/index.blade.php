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
                                        <a href="" class="btn btn-dark btn-outline-secondary"><i class='bx bxs-edit text-white'></i></a>
                                        <a href="" class="btn btn-dark btn-outline-secondary"><i class='bx bxs-trash text-white'></i></a>
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
			let table = $('#example').DataTable( {
			} );
            $('.dataTables_filter input').addClass('border border-2 border-dark');
			
		} );
        
</script>
    
@endpush

@endsection
