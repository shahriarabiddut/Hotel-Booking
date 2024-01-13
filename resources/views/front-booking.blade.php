@extends('frontlayout')
@section('title')
Room Booking
@endsection
@section('frotendContent')
<div class="container">

    <h1 class="h3 mt-2 text-gray-800" style="margin-top:10%;">Room Booking</h1>
    <!-- Booking Tables  -->
    <div class="card shadow mb-4">
        <!-- Session Messages Starts -->
        @if(Session::has('success'))
        <div class="p-3 mb-2 bg-success text-white">
            <p>{{ session('success') }} </p>
        </div>
        @endif
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add New Booking</h6>
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
                        <th>View RoomType Details</th> 
                        <td><a href="{{ route('cshow') }}">View</a></td> 
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
                            <input type="hidden" name="ref" value="front">
                            <input type="hidden" name="customer_id" value="{{ session('CustomerData')[0]->id }}">
                            <button type="submit" class="float-right btn btn-primary">Submit</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </form>
            </div>
        </div>
    </div>
</div>
@section("scriptsFront")
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