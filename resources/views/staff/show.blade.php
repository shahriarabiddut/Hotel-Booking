@extends('layout')
@section('title', 'Staff Details')
@section('content')


    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"> Staff Details </h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Staff Details of {{ $data->title }} 
            <a href="{{ url('admin/staff') }}" class="float-right btn btn-success btn-sm"> <i class="fa fa-arrow-left"></i> View All </a> </h6>
        </div>
        <div class="card-body">
            
            <div class="table-responsive">
                <table class="table table-bordered" width="100%">
                        <tr>
                            <th>Photo</th>
                            <td><img width="100" src="{{$data->photo ? asset('storage/'.$data->photo) : url('storage/images/user.png')}}" alt="User Photo"></td>
                        </tr>
                        <tr>
                       <th>Full Name </th>
                            <td>{{ $data->full_name }}</td>
                        </tr><tr>
                            <th>Department</th>
                            <td>{{ $data->department->title }}</td>
                        </tr><tr>
                            <th>Bio </th>
                            <td>{{ $data->bio }}</td>
                        </tr><tr>
                            <th>Salary Type </th>
                            <td>{{ $data->salary_type }}</td>
                        </tr><tr>
                            <th>Salary Amount</th>
                            <td>{{ $data->salary_amount }}</td>
                        </tr><tr>
                            <td colspan="2">
                                <a href="{{ url('admin/staff/'.$data->id.'/edit') }}" class="float-right btn btn-info btn-sm"><i class="fa fa-edit"> Edit {{ $data->title }} </i></a>
                            </td>
                            
                        </tr>
                        
                </table>
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

