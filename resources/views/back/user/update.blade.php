
@extends('back.layout.template')
@section('title', Auth::user()->name . ' - Edit User')
@section('content')

                   <!-- ========== Left Sidebar Start ========== -->
     
<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from coderthemes.com/adminto/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 04 Feb 2024 04:12:35 GMT -->
<head>

        <meta charset="utf-8" />

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/.ico">

    

    </head>

    <!-- body start -->
    <body class="loading" data-layout-color="light"  data-layout-mode="default" data-layout-size="fluid" data-topbar-color="light" data-leftbar-position="fixed" data-leftbar-color="light" data-leftbar-size='default' data-sidebar-user='true'>

        <!-- Begin page -->


            {{-- navbar  --}}
            @include('back.layout.navbar')
            {{-- end navbar  --}}
            <!-- sidebar  -->
            @include('back.layout.sidebar')
            <!-- sidebar end  -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->
         
            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">

                        <div class="row">

                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body table-responsive">
                                        <h4 class="mt-0 header-title">User</h4>
                                        <p class="text-muted font-14 mb-3">
                                            Edit data User
                                        </p>
    
                                        @if ($errors->any())
                                        <div class="my-3">
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{$error}}</li>
                                                    @endforeach
                                                </ul>
                                            </div> 
                                        </div> 
                                        @endif
                                        <form action="{{ url('users/'.$users->id_user) }}" method="POST" enctype="multipart/form-data">
                                            @method('PUT')  
                                            @csrf
                                       <div class="row">
                                        <div class="mb-3 col-md-12">
                                            <label for="name">Foto</label>
                                            <input type="file" name="foto" id="img" class="form-control mb-2" >                                                       
                                            @empty($users->foto)
                                                <p>Foto Profile tidak ada</p>
                                            @else
                                                <div class="mt-2" >
                                                    <small class="row" style="margin-left:5px">Foto lama:</small>
                                                    <img src="{{ asset('storage/fotoProfile/'.$users->foto) }}" class="img-thumbnail img-preview" alt="Foto Pengguna" width="120px">                              
                                                </div>
                                            @endempty
                                        </div>
                                        
                        
                                        <div class=" mb-3 col-md-12">
                                            <label for="name">Name</label>
                                            <input class="input @error('name') is-invalid @enderror form-control" name="name" 
                                            id="name" type="text" placeholder="Name" value="{{old('name', $users->name) }}">
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                        
                                        <div class=" mb-3 col-md-12">
                                            <label for="telepon">Telepon</label>
                                            <input class="input @error('telepon') is-invalid @enderror form-control" name="telepon" 
                                            id="telepon" type="text" placeholder="no telp" value="{{old('telepon', $users->telepon) }}">
                                            @error('telepon')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                        
                                        <div class=" mb-3 col-md-12">
                                            <label for="level">Level</label>
                                            <select name="level" id="user_id" class="form-control">
                                                @foreach ($levels as $level)
                                                    <option value="{{ $level }}" {{ old('level', $users->level) == $level ? 'selected' : '' }}>
                                                        {{ $level }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            
                                            
                                            @error('level')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                        
                        
                                        <div class="mb-3 col-md-12">
                                          <label for="email">Email</label>
                                          <input class="input @error('email') is-invalid @enderror form-control" name="email"
                                          id="email" type="email" placeholder="Email" value="{{old('email', $users->email)}}" >
                                          @error('email')
                                              <div class="invalid-feedback">
                                                  {{$message}}
                                              </div>
                                          @enderror
                                      </div>
                        
                                      <div class="mb-3 col-md-12">
                                        <label for="password">password</label>
                                        <input class="input @error('password') is-invalid @enderror form-control" name="password" class="form-control"
                                        id="password" type="password" placeholder="password" value="{{old('password')}}">
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                      </div>
                                    <div class="mb-3 col-md-12">
                                      <label for="konfirmasi_password">Konfirmasi Password</label>
                                      <input class="input @error('konfirmasi_password') is-invalid @enderror form-control" name="password_confirmation" class="form-control"
                                      id="konfirmasi_password" type="password" placeholder="konfirmasi password" value="{{old('konfirmasi_password')}}">
                                      @error('konfirmasi_password')
                                          <div class="invalid-feedback">
                                              {{$message}}
                                          </div>
                                      @enderror
                                  </div>
                                       </div>
                                       <div class="text-center">
                                        <a href="{{url('users')}}" class="btn btn-light">Kembali</a>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                    </div>
                          
                                    </form>
                                    
                            
                                    </div>
                                </div>
                               
                            </div>
               

                           
                        </div>
                        <!-- end row -->
 
                    </div>
                     <!-- container-fluid -->
                </div> 
                <!-- content -->

                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <script>document.write(new Date().getFullYear())</script> &copy; Inventory barang <a href="#">Lennwilldayy  </a> 
                            </div>
                            <div class="col-md-6">
                                <div class="text-md-end footer-links d-none d-sm-block">
                                    <a href="javascript:void(0);">About Us</a>
                                    <a href="javascript:void(0);">Help</a>
                                    <a href="javascript:void(0);">Contact Us</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>
            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

        <!-- END wrapper -->

   
        @include('back.layout.right')

        <!-- Right bar overlay-->
        
    
		@push('js')
<script>
    
// img preview 
$("#img").change(function(){
    previewImage(this);
});
function previewImage(input){
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e){
            $('.img-preview').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
    </body>

<!-- Mirrored from coderthemes.com/adminto/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 04 Feb 2024 04:13:20 GMT -->
</html>
@endsection