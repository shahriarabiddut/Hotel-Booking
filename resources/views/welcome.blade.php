
@extends('frontlayout')
@section('frotendContent')
{{-- Navbar End --}}

{{-- Slider Start --}}
<div class="container my-4">
    <div class="row">
    <!-- Session Messages Starts -->
    @if(Session::has('success'))
    <div class="p-3 mt-5 bg-success text-white">
        <p>{{ session('success') }} </p>
    </div>
    @endif
    @if(Session::has('danger'))
    <div class="p-3 mt-5 bg-danger text-white">
        <p>{{ session('danger') }} </p>
    </div>
    @endif

    </div>
</div>

{{-- Slider End --}}



{{-- Extra --}}
<link rel="stylesheet" href="{{ asset('vendor/lightbox2-dev/dist/css/lightbox.min.css') }}">
<script type="text/javascript" src="{{ asset('vendor/lightbox2-dev/dist/js/lightbox.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/lightbox2-dev/dist/js/lightbox-plus-jquery.js') }}"></script>

@endsection