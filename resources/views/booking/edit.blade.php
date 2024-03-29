@extends('layout')
@section('title', 'Edit Booking')
@section('content')


    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Editing Booking: {{ $data->full_name }}</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Booking
            <a href="{{ url('admin/booking/'.$data->id) }}" class="float-right btn btn-success btn-sm"> <i class="fa fa-arrow-left"></i> View All </a> </h6>
        </div>
        <div class="card-body">
            
            <div class="table-responsive">
            <form method="POST" action="{{ route('booking.update',$data->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tbody>
                    <tr>
                        <th>Full Name <span class="text-danger">*</span></th>
                        <td><input required readonly name="full_name" type="text" class="form-control" value="{{ $data->customer->full_name }}"></td>
                    </tr>
                         <tr>
                             <th>Total Adults <span class="text-danger">*</span></th>
                             <td><input required name="total_adults" type="number" class="form-control" value="{{ $data->total_adults }}"></td>
                         </tr><tr>
                             <th>Total Children <span class="text-danger">*</span></th>
                             <td><input required name="total_children" type="number" class="form-control" value="{{ $data->total_children }}"></td>
                         </tr>
                    <tr>
                        <td colspan="2">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </form>
            </div>
        </div>
    </div>

    @section('scripts')
    <!-- Page level plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    
    @endsection
@endsection

