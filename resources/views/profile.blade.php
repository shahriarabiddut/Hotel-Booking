@extends('layout')

@if(Session::has('adminData'))
@section('title')
Profile -  {{ session('adminData')[0]->full_name }}
@endsection
@endif

@section('frotendContent')
<div class="container">

    <div class="card-body">
            
        <div class="table-responsive">
            <table class="table table-bordered" width="100%">
                    <tr>
                        <th>Photo</th>
                        <td><img width="100" src="{{session('adminData')[0]->photo ? asset('storage/'.session('adminData')[0]->photo) : url('storage/images/user.png')}}" alt="User Photo"></td>
                    </tr>
                    <tr>
                   <th>Full Name </th>
                        <td>{{ session('adminData')[0]->full_name }}</td>
                    </tr><tr>
                        <th>Email</th>
                        <td>{{ session('adminData')[0]->email }}</td>
                    </tr><tr>
                        <th>Mobile No </th>
                        <td>{{ session('adminData')[0]->mobile }}</td>
                    </tr><tr>
                        <th>Address</th>
                        <td>{{ session('adminData')[0]->address }}</td>
                    </tr><tr>
                        <td colspan="2">
                            <a href="{{ url('customer/profile/'.session('adminData')[0]->id.'/edit') }}" class="float-right btn btn-info btn-sm"><i class="fa fa-edit"> Edit profile  </i></a>
                        </td>
                        
                    </tr>
                    
            </table>
        </div>
    </div>

</div>
@section("scriptsFront")

@endsection

@endsection