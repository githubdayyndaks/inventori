<!DOCTYPE html>
<html lang="en">
  <!-- Mirrored from coderthemes.com/adminto/layouts/auth-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 04 Feb 2024 04:16:23 GMT -->
  <head>
    <meta charset="utf-8" />
    <title>Log In | Adminto - Responsive Admin Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('Admin/images/favicon.ico')}}" />

    <!-- App css -->

    <link href="{{asset('Admin/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- icons -->
    <link href="{{asset('Admin/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
  </head>

  <body class="loading authentication-bg authentication-bg-pattern">
    <div class="account-pages my-5">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-8 col-lg-6 col-xl-4">
            <div class="text-center">
              <a href="index.html">
                <p class="text-white " style="font-size: 28px;"><b>Lennwilldayy</b></p>
                {{-- <img src="{{asset('Admin/images/logo-dark.png')}}" alt="" height="22" class="mx-auto" /> --}}
              </a>
              <p class="text-white mt-2 mb-4">Login Inventory barang</p>
            </div>
            <div class="card">
              <div class="card-body p-4">
                <div class="text-center mb-4">
                  <h4 class="text-uppercase mt-0">Log In</h4>
                  @if($errors->any())
                  <div class="alert alert-danger" role="alert">
                    <ul>
                      @foreach($errors->all() as $item)
                      <li>{{$item}}</li>
                      @endforeach
                    </ul>
                  </div>
                  @endif
                </div>

                <form action="#" method="POST">
                  @csrf

                  <div class="mb-3">
                    <label for="emailaddress" class="form-label">Email address</label>
                    <input class="form-control" type="email" id="emailaddress" name="email" value="{{old('email')}}" placeholder="Enter your email" />
                  </div>

                  <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input class="form-control" type="password" name="password" id="password" placeholder="Enter your password" />
                  </div>

                  <div class="mb-3">
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="checkbox-signin" checked />
                      <label class="form-check-label" for="checkbox-signin">Remember me</label>
                    </div>
                    <a href="/">Kembali ke landingpage</a>
                  </div>

                  <div class="mb-3 d-grid text-center">
                    <button class="btn btn-primary" type="submit">Log In</button>
                  </div>
                </form>
              </div>
              <!-- end card-body -->
            </div>
            <!-- end card -->

        
          <!-- end col -->
        </div>
        <!-- end row -->
      </div>
      <!-- end container -->
    </div>
    <!-- end page -->

    <!-- Vendor -->
    <script src="{{asset('Admin/libs/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('Admin/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('Admin/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('Admin/libs/node-waves/waves.min.js')}}"></script>
    <script src="{{asset('Admin/libs/waypoints/lib/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('Admin/libs/jquery.counterup/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('Admin/libs/feather-icons/feather.min.js')}}"></script>

    <!-- App js -->
    <script src="{{asset('Admin/js/app.min.js')}}"></script>
  </body>

  <!-- Mirrored from coderthemes.com/adminto/layouts/auth-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 04 Feb 2024 04:16:24 GMT -->
</html>
