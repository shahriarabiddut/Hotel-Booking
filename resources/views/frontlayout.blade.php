<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('bs5/bootstrap.min.css') }}">
    <script type="text/javascript" src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <link href="{{  asset('vendor/fontawesome-free/css/all.min.css')  }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

        <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <title>LaraHotel -  @yield('title')</title>
</head>
<body>

{{-- Navbar Start --}}
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">
          <a class="navbar-brand" href="/">LaraHotel</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse " id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto">
              <a class="nav-link " aria-current="page" href="#service">Service</a>
              <a class="nav-link" href="#Gallery">Gallery</a>
              @if (Session::has('customerLogin'))
              <a class="nav-link btn btn-sm btn-danger" href="{{ url('booking') }}">Booking</a>
              <li class="nav-item dropdown no-arrow bg-white ">
                <a class="nav-link dropdown-toggle text-white" href="#" id="userDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><b> {{ session('CustomerData')[0]->full_name }} </b>
                    <img class="image-thumbnail  rounded" width="25px" src="{{session('CustomerData')[0]->photo ? asset('storage/'.session('CustomerData')[0]->photo) : url('storage/images/user.png')}}" alt="User Photo"
                    alt="...">
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="{{ route('customerProfile') }}">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('mybookings') }}">
                        <i class="fas fa-hotel fa-sm fa-fw mr-2 text-gray-400"></i>
                        My Bookings
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="customer/logout" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </a>
                </div>
            </li>
              @else
              <a class="nav-link btn btn-sm btn-info" href="{{ url('/customer/login') }}">Login</a>
              <a class="nav-link btn btn-sm btn-info" href="{{ url('/customer/register') }}">Register</a>
              <a class="nav-link btn btn-sm btn-danger" @disabled(true) href="#">Booking</a>

              @endif
              
              <a class="nav-link btn btn-sm btn-success" aria-current="page" href="/admin">Admin</a>
            </div>
          </div>
        </div>
      </nav>
{{-- Navbar End --}}
 <!-- Logout Modal-->
 <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
 aria-hidden="true">
 <div class="modal-dialog" role="document">
     <div class="modal-content">
         <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
             <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">×</span>
             </button>
         </div>
         <div class="modal-body">Are You Sure You Want To Logout?</div>
         <div class="modal-footer">
             <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
             <a class="btn btn-primary" href="{{ env('APP_URL') }}customer/logout">Logout</a>
         </div>
     </div>
 </div>
</div>
 <!-- Logout Modal-->

    <main style="position: relative;">
    @yield('frotendContent')
    </main>
<!-- Bootstrap core JavaScript-->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
      @yield('scriptsFront')
</body>
</html>