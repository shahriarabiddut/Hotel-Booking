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
                    <tr>
                        <th>Photo</th>
                        <td><img width="100" src="{{session('CustomerData')[0]->photo ? asset('storage/'.session('CustomerData')[0]->photo) : url('storage/images/user.png')}}" alt="User Photo"></td>
                    </tr>
                    <tr>
                   <th>Full Name </th>
                        <td>{{ session('CustomerData')[0]->full_name }}</td>
                    </tr><tr>
                        <th>Email</th>
                        <td>{{ session('CustomerData')[0]->email }}</td>
                    </tr><tr>
                        <th>Mobile No </th>
                        <td>{{ session('CustomerData')[0]->mobile }}</td>
                    </tr><tr>
                        <th>Address</th>
                        <td>{{ session('CustomerData')[0]->address }}</td>
                    </tr><tr>
                        <td colspan="2">
                            <a href="{{ url('customer/profile/'.session('CustomerData')[0]->id.'/edit') }}" class="float-right btn btn-info btn-sm"><i class="fa fa-edit"> Edit profile  </i></a>
                        </td>
                        
                    </tr>
                    
            </table>
        </div>
    </div>

</div>
@section("scriptsFront")

@endsection

@endsection