@extends('frontlayout')
@section('title')
Home
@endsection
@section('frotendContent')
{{-- Navbar End --}}

      {{-- Slider Start --}}
      <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="{{ asset('img/banner1.jpg') }}" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="{{ asset('img/banner2.jpg') }}" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="{{ asset('img/banner3.jpg') }}" class="d-block w-100" alt="...">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
      
      {{-- Slider End --}}
      {{-- Service Start --}}
      <div class="container my-4" id="service">
        <h1 class="text-center border-bottom bg-warning"> Services </h1>
        <div class="row my-4">
            <div class="col-md-4">
                <img src="{{ asset('img/mario.jpg') }}" alt="" class="img-thumbnail">
            </div>
            <div class="col-md-8">
                <h3 class="text-center">Service Heading</h3>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Iure, itaque. Amet iste expedita saepe natus vero quis, voluptate nam, velit obcaecati deleniti iusto? Neque, quasi! Similique cum iure molestias aspernatur?
                Inventore voluptatibus ut atque tempora beatae, dignissimos commodi error corporis ab quia.Lorem ipsum dolor sit, amet consectetur adipisicing elit. Iure, itaque. Amet iste expedita saepe natus vero quis, voluptate nam, velit obcaecati deleniti iusto? Neque, quasi! Similique cum iure molestias aspernatur?
                    Inventore voluptatibus ut atque tempora beatae, dignissimos commodi error corporis ab quia.</p>
                <p><a href="#" class="btn btn-large btn-primary">Read More</a></p>
            </div>
        </div>
        <div class="row my-4">
            <div class="col-md-4">
                <img src="{{ asset('img/mario.jpg') }}" alt="" class="img-thumbnail">
            </div>
            <div class="col-md-8">
                <h3 class="text-center">Service Heading 2</h3>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Iure, itaque. Amet iste expedita saepe natus vero quis, voluptate nam, velit obcaecati deleniti iusto? Neque, quasi! Similique cum iure molestias aspernatur?
                Inventore voluptatibus ut atque tempora beatae, dignissimos commodi error corporis ab quia.Lorem ipsum dolor sit, amet consectetur adipisicing elit. Iure, itaque. Amet iste expedita saepe natus vero quis, voluptate nam, velit obcaecati deleniti iusto? Neque, quasi! Similique cum iure molestias aspernatur?
                    Inventore voluptatibus ut atque tempora beatae, dignissimos commodi error corporis ab quia.</p>
                <p><a href="#" class="btn btn-large btn-primary">Read More</a></p>
            </div>
        </div>
      </div>
      {{-- Service End --}}
      {{-- Gallery Start --}}
    <div class="container my-4" id="Gallery">
        <h1 class="text-center border-bottom bg-info"> Gallery </h1>
        <div class="row my-4">
          @foreach ($roomTypes as $roomType)
            <div class="col-md-3">
                <div class="card">
                  <h6 class="card-header bg-info ">{{ $roomType->title }} Gallery </h6>
                  <div class="card-body">
                      @foreach ($roomType->roomtypeimages as $index=> $img)
                      <a href="{{$img->img_src ? asset('storage/'.$img->img_src) : ''}}" data-lightbox="rgallery{{ $roomType->id }} ">
                      @if ($index>0)
                      <img class="img-fluid " style="display: none;" src="{{$img->img_src ? asset('storage/'.$img->img_src) : ''}}" alt="{{$img->img_alt ? asset('storage/'.$img->img_alt) : ''}}"> </a>
                      @else 
                      <img class="img-fluid " src="{{$img->img_src ? asset('storage/'.$img->img_src) : ''}}" alt="{{$img->img_alt ? asset('storage/'.$img->img_alt) : ''}}"> </a>
                       @endif
                      @endforeach
                  </div>
                </div>
            </div>
        @endforeach
            
        </div>
    </div>
        
      
      {{-- Gallery End --}}


      {{-- Extra --}}
    <link rel="stylesheet" href="{{ asset('vendor/lightbox2-dev/dist/css/lightbox.min.css') }}">
    <script type="text/javascript" src="{{ asset('vendor/lightbox2-dev/dist/js/lightbox.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/lightbox2-dev/dist/js/lightbox-plus-jquery.js') }}"></script>

 @endsection