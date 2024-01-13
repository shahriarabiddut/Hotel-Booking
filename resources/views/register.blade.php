@extends('frontlayout')
@section('title')
Register
@endsection
@section('frotendContent')
<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                        </div>
                        <form method="POST" action="{{ route('customer.store') }}" enctype="multipart/form-data">
                            @csrf
                            @if ($errors->any())
                            @foreach ($errors->all() as $error)
                            <p class="text-danger"> {{ $error }} </p>
                            @endforeach
                            @endif
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <tbody>
                                <tr>
                               <th>Full Name <span class="text-danger">*</span></th>
                                    <td><input required name="full_name" type="text" class="form-control" value="{{old('full_name')}}"></td>
                                </tr><tr>
                                    <th>Email <span class="text-danger">*</span></th>
                                    <td><input required name="email" type="email" class="form-control" value="{{old('email')}}"></td>
                                </tr><tr>
                                    <th>Password <span class="text-danger">*</span></th>
                                    <td><input required name="password" type="password" class="form-control" value="{{old('password')}}"></td>
                                </tr><tr>
                                    <th>Mobile No <span class="text-danger">*</span></th>
                                    <td><input required name="mobile" type="text" class="form-control" value="{{old('mobile')}}"></td>
                                </tr><tr>
                                    <th>Address</th>
                                    <td><textarea name="address" class="form-control">{{old('address')}}</textarea></td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <input type="hidden" name="ref" value="front">
                                        <button type="submit" class="btn btn-primary btn-user btn-block">Register Account</button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </form>

                            <hr>
                            <p class=" text-center"> Do You Have an Account ?</p>
                            <a href="{{ url('/customer/login') }}" class="btn btn-primary btn-user btn-block">
                                Login
                            </a>
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection