@extends('frontlayout')
@section('title', 'Room Types')
@section('frotendContent')
<div class="container">
@foreach ($roomType as $data)
    <!-- DataTales Example -->
    <div class="card shadow mt-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $data->title }} Room
                
        </h6>
        </div>
        <div class="card-body">
            
            <div class="table-responsive">
                <table class="table table-bordered" width="100%">
                    
                    <tr>
                        <th width="20%">Title</th>
                        <td width="80%">{{ $data->title }}</td>
                    </tr><tr>
                        <th>Price</th>
                        <td>{{ $data->price }}</td>
                    </tr><tr>
                        <th>Details</th>
                        <td>{{ $data->details }}</td>
                    </tr><tr>
                        <th>Gallery Images</th>
                        <td>
                        <table class="table table-bordered">
                            <tr>
                                @foreach ($data->roomtypeimages as $img)
                                <td class="imgcol{{$img->id}}">
                                    <img width="200px" src="{{$img->img_src ? asset('storage/'.$img->img_src) : ''}}" alt="{{$img->img_alt ? asset('storage/'.$img->img_alt) : ''}}">
                                </td>
                                @endforeach
                                
                            </tr>
                        </table>
                        </td>
                    </tr>
                    
                </table>
            </div>
        </div>
    </div>
    @endforeach
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

