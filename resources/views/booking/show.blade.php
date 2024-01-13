@extends('layout')
@section('title', 'Booking Details')
@section('content')


    <!-- Page Heading -->
    @if(Session::has('success'))
    <div class="p-3 mb-2 bg-success text-white">
        <p>{{ session('success') }} </p>
    </div>
    @endif
    @if(Session::has('danger'))
    <div class="p-3 mb-2 bg-danger text-white">
        <p>{{ session('danger') }} </p>
    </div>
    @endif
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary">Booking Details of {{ $data->id }} by {{ $data->customer->full_name }} 
            <a href="{{ url('admin/booking') }}" class="float-right btn btn-success btn-sm"> <i class="fa fa-arrow-left"></i> View All </a> </h3>
        </div>
        <div class="card-body">
            
            <div class="table-responsive">
                <table class="table table-bordered" width="100%">
                    
                        <tr>
                       <th>Customer Full Name </th>
                            <td>{{ $data->customer->full_name }}</td>
                        </tr><tr>
                            <th>Selected Room</th>
                            <td>{{ $data->room->title }}</td>
                        </tr><tr>
                            <th>Selected Room Type</th>
                            <td>{{ $data->room->Roomtype->title }}</td>
                        </tr><tr>
                            <th>Checkin Date</th>
                            <td>{{ $data->checkin_date }}</td>
                        </tr><tr>
                            <th>CheckOut Date</th>
                            <td>{{ $data->checkout_date }}</td>
                        </tr><tr>
                            <th>Booking Creation Date</th>
                            <td>{{ $data->created_at }}</td>
                        </tr><tr>
                            <th>Booking Updated Date</th>
                            <td>{{ $data->updated_at }}</td>
                        </tr>
                        <tr>
                            <th>Bill</th>
                            <td>
                            @if ($data->bill!=null)
                            @if ($data->bill->status==0)
                            Due <a href="{{ route('admin.payment',$data->id) }}" class="btn text-white btn-info mx-1">Pay</a>
                            @elseif ($data->bill->status==1)
                            Processing (Bill - {{ $data->bill->price }} Tk)  <a href="{{ route('admin.paymentAccept',$data->id) }}" class="btn text-white btn-success mx-1">Accept Payment</a>
                            @else 
                            Paid (Bill - {{ $data->bill->price }} Tk)
                            @endif 
                            @endif   
                            </td>
                        </tr><tr>
                            <td colspan="2">
                                <a href="{{ url('admin/booking/'.$data->id.'/edit') }}" class="float-right btn btn-info btn-sm"><i class="fa fa-edit"> Edit {{ $data->title }}  </i></a>
                            </td>
                            
                        </tr>
                        
                </table>
            </div>
        </div>
    </div>
    @if ($data->bill!=null)
    @if ($data->bill->payment!=null)
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary">Payment </h3>
        </div>
        <div class="card-body">
            
            <div class="table-responsive">
                <table class="table table-bordered" width="100%">
                        <tr>
                            <th>Method </th>
                            <td>{{ $data->bill->payment->method }}</td>
                        </tr>
                </table>
            </div>
        </div>
    </div>
    @endif
    @endif
    @section('scripts')
    <!-- Page level plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    @endsection
@endsection

