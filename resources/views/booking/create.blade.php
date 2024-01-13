@extends('layout')
@section('title', 'Add Booking')
@section('content')


    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Add Booking</h1>


    <!-- Booking Tables  -->
    <div class="card shadow mb-4">
        <!-- Session Messages Starts -->
        @if(Session::has('success'))
        <div class="p-3 mb-2 bg-success text-white">
            <p>{{ session('success') }} </p>
        </div>
        @endif
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add New Booking
            <a href="{{ url('admin/booking') }}" class="float-right btn btn-success btn-sm"> <i class="fa fa-arrow-left"></i> View All </a> </h6>
        </div>
        <div class="card-body">
            
            <div class="table-responsive">
                @if ($errors->any())
                @foreach ($errors->all() as $error)
                   <p class="text-danger"> {{ $error }} </p>
                @endforeach
                @endif
            <form method="POST" action="{{ route('booking.store') }}" enctype="multipart/form-data">
                @csrf
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tbody>
                    <tr>
                        <th>Customers <span class="text-danger">*</span></th>
                        <td><select name="customer_id" class="form-control">
                            <option value="0"> -- Select Customer --</option>
                            @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}"> {{ $customer->full_name }}</option>
                            @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                   <th>CheckIn Date <span class="text-danger">*</span></th>
                        <td><input required name="checkin_date" type="date" class="form-control checkin-date"></td>
                    </tr><tr>
                        <th>CheckOut Date  <span class="text-danger">*</span></th>
                        <td><input required name="checkout_date" type="date" class="form-control"></td>
                    </tr><tr>
                        <th>Available Rooms</th>
                        <td><select name="room_id" class="form-control room-list">
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Total Adults <span class="text-danger">*</span></th>
                        <td><input required name="total_adults" type="number" class="form-control"></td>
                    </tr><tr>
                        <th>Total Children <span class="text-danger">*</span></th>
                        <td><input required name="total_children" type="number" class="form-control"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button type="submit" class="float-right btn btn-primary">Submit</button>
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

    <script type="text/javascript">
        $(document).ready(function(){
            $(".checkin-date").on('blur',function(){
                let _checkindate = $(this).val();
                //Ajax
                $.ajax({
                    url:"{{ url('admin/booking') }}/available-rooms/" + _checkindate,
                    // type:'post',
                    dataType:'json',
                    beforeSend:function(){
                        $(".room-list").html('<option>-- Loading --</option>');
                    },
                    success:function(res){
                        let _html = '';
                        $.each(res.data,function(index,row){
                            _html+='<option value="'+row.room.id+'">'+row.room.title+' - '+row.roomtype.title+'</option>';
                        });
                        $(".room-list").html(_html);
                    }
                });
            });
        });
    </script>
    @endsection
@endsection

