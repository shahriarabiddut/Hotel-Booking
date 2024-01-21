@extends('layout')
@section('title', 'Create Bill')
@section('content')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Bill
            <a href="{{ route('admin.bill.index') }}" class="float-right btn btn-success btn-sm"> <i class="fa fa-arrow-left"></i> View All </a> </h6>
        </div>
        <div class="card-body">
            
            <div class="table-responsive">
            <form method="POST" action="{{ route('admin.bill.generate') }}" enctype="multipart/form-data">
                @csrf
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tbody>
                        <tr>
                            <th>Customer <span class="text-danger">*</span></th>
                                <td><select required name="customer" class="form-control room-list">
                                        <option value="0">Select Customer</option>
                                        @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}"> {{ $customer->full_name }} ( {{ $customer->mobile }})</option>
                                        @endforeach
                                        </select></td>
                            </tr>
                        <tr>
                        <tr>
                            <th>Facility </th>
                                <td><select name="facility[]" class="form-control room-list" multiple>
                                        <option value="0">Select Facility</option>
                                        @foreach ($facility as $customer)
                                        <option value="{{ $customer->id }}"> {{ $customer->title }}</option>
                                        @endforeach
                                        </select></td>
                            </tr>
                        <tr> <th>Food Bill </th>
                            <td><input type="text" class="form-control room-list" name="foodbill" placeholder="Enter Food Bills"></td></tr>
                    
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

