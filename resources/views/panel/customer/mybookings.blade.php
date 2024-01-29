@extends('frontlayout')

@if(!Session::has('CustomerData'))
        <script>
            window.location.href="{{ url('customer/login') }}";
        </script>
@else
@section('title')
Profile -  {{ session('CustomerData')[0]->full_name }}
@endsection
@endif

@section('frotendContent')
<div class="container">

    <div class="card-body">
            
        <div class="table-responsive">
            <table class="table table-bordered" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Room No.</th>
                        <th>Room Type</th>
                        <th>Checkin Date</th>
                        <th>CheckOut Date</th>
                        <th>Bill Status</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Room No.</th>
                        <th>Room Type</th>
                        <th>Checkin Date</th>
                        <th>CheckOut Date</th>
                        <th>Bill Status</th>
                    </tr>
                </tfoot>
                @if($data)
                        @foreach ($data as $key => $d)
                        <tr>
                            <td>{{ $d->id }}</td>
                            <td>{{ $d->room->title }}</td>
                            <td>{{ $d->room->RoomType->title }}</td>
                            <td>{{ $d->checkin_date }}</td>
                            <td>{{ $d->checkout_date }}</td>
                            <td>
                                @if ($d->bill->status==0)
                                 Due <a href="{{ route('payment',$d->id) }}" class="btn text-white btn-info mx-1">Pay</a>
                                @elseif ($d->bill->status==1)
                                Processing (Bill - {{ $d->bill->price }} Tk)
                                @else 
                                Paid (Bill - {{ $d->bill->price }} Tk)
                                @endif
                            </td>
                            

                        </tr>
                        @endforeach
                        @endif
            </table>
        </div>
    </div>

</div>
@section("scriptsFront")

@endsection

@endsection