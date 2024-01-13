<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Larahall - Customer Login</title>

        <!-- Custom fonts for this template-->
        <link href="{{  asset('vendor/fontawesome-free/css/all.min.css')  }}" rel="stylesheet" type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">
    
            <!-- Custom styles for this template-->
        <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    @if(Session::has('invalidMessage'))
                                    <div class="p-3 mb-2 bg-danger text-white">
                                        <p>{{ session('invalidMessage') }} </p>
                                    </div>
                                    @endif
                                    <div class="text-center">
                                        @if ($errors->any())
                                        @foreach ($errors->all() as $error)
                                        <p class="text-danger"> {{ $error }} </p>
                                        @endforeach
                                        @endif
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back Customer!</h1>
                                    </div>
                                    <form class="user" method="post" action="{{ url('customer/login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                @if (Cookie::has('CustomerEmail'))
                                                    value="{{ Cookie::get('CustomerEmail') }}"
                                                @endif
                                                id="email" aria-describedby="emailHelp"
                                                placeholder="Enter Email" name="email">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                            @if (Cookie::has('Customerpwd'))
                                                    value="{{ Cookie::get('Customerpwd') }}"
                                            @endif
                                            id="exampleInputPassword" placeholder="Password" name="password">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" name="rememberme"
                                                @if (Cookie::has('CustomerEmail'))
                                                    checked
                                                @endif
                                                class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <input type="submit" class="btn btn-success btn-user btn-block" value="Login">   
                                    </form>
                                    <hr/>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html"
                                        >Forgot Password?</a>
                                    </div>
                                    <hr>
                                    <div class="text-center  btn btn-info btn-user btn-block">
                                        <a class="medium text-white" href="/"
                                            > <b> Home Page </b></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

</body>

</html>