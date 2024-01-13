@extends('layout')
@section('title', 'Create New Staff Payment')
@section('content')


    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Create New Staff Payment</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add New Payment to {{ $staff->full_name  }}
            <a href="{{ url('admin/staff/payments/'.$staff_id) }}" class="float-right btn btn-success btn-sm"> <i class="fa fa-arrow-left"></i> View Payments </a> </h6>
        </div>
        <div class="card-body">
            <!-- Session Messages Starts -->
            @if(Session::has('success'))
            <div class="p-3 mb-2 bg-success text-white">
                <p>{{ session('success') }} </p>
            </div>
            @endif
            <div class="table-responsive">
                @if ($errors->any())
                @foreach ($errors->all() as $error)
                   <p class="text-danger"> {{ $error }} </p>
                @endforeach
                @endif
            <form method="POST" action="{{ url('admin/staff/payment/'.$staff_id) }}" enctype="multipart/form-data">
                @csrf
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tbody>
                        <tr>
                            <th>Salary Payable to {{ $staff->full_name  }} </span></th>
                            <td> {{ $staff->salary_amount  }} per 
                                @switch($staff->salary_type)
                                    @case('monthly')
                                        Month
                                        @break
                                
                                    @case('daily')
                                        Day
                                        @break
                                        
                                @endswitch
                            </td>
                        </tr>
                        <tr>
                        <th>Salary Amount<span class="text-danger">*</span></th>
                        <td><input required name="amount" type="text" class="form-control"></td>
                    </tr><tr>
                        <th>Date<span class="text-danger">*</span></th>
                        <td><input required name="amount_date" type="date" class="form-control"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button type="submit" class="btn btn-primary">Submit</button>
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

