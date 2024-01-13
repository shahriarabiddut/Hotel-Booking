@extends('layout')
@section('title', 'Add Payment')
@section('content')
<div class="container">
    <!-- Booking Tables  -->
    <div class="card shadow mb-4">
        <!-- Session Messages Starts -->
        @if(Session::has('success'))
        <div class="p-3 mb-2 bg-success text-white">
            <p>{{ session('success') }} </p>
        </div>
        @endif
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add Payment</h6>
        </div>
        <div class="card-body">
            
            <div class="table-responsive">
                @if ($errors->any())
                @foreach ($errors->all() as $error)
                   <p class="text-danger"> {{ $error }} </p>
                @endforeach
                @endif
            <form method="POST" action="{{ route('payment.store') }}" enctype="multipart/form-data">
                @csrf
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tbody>
                        <tr>
                            <th>Mobile Banking Number Merchant</th>
                            <td>Bkash - 0123020302130 , DBBL - 32130213213</td>
                        </tr>
                    <tr>
                        <th>Payment Method <span class="text-danger">*</span></th>
                        <td><input required name="method" type="text" class="form-control" placeholder="Enter Mobile Banking Number , Bank and Transaction ID"></td>
                    </tr><tr>
                        <th>Payable Amount <span class="text-danger">*</span></th>
                        <td><input readonly name="price" type="number" class="form-control" value="{{ $data->bill->price }}"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="bill_id" value="{{ $data->bill->id }}">
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
@endsection

@endsection