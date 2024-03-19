@extends('back.layout.template')
@section('title', Auth::user()->name . ' - Edit Kategori')
@section('content')
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
                                        <h4 class="mt-0 header-title">Kategori</h4>
                                        <p class="text-muted font-14 mb-3">
                                            Edit data kategori
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
                                     

                                        <form action="{{url('kategori/'.$kategori->kode_kategori)}}" method="POST" enctype="multipart/form-data">
                                            @method('PUT')
                                            @csrf
                                       <div class="row">
                                        <div class=" mb-3 col-md-12">
                                            <label for="kode_kategori">Kode kategori</label>
                          <input class="input @error('kode_kategori') is-invalid @enderror form-control" name="kode_kategori" readonly id="kode_kategori" type="text" 
                            value="{{old('kode_kategori', $kategori->kode_kategori)}}">

                                            @error('kode_kategori')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class=" mb-3 col-md-12">
                                            <label for="nama_kategori">Nama kategori</label>
                                            <input class="input @error('nama_kategori') is-invalid @enderror form-control" name="nama_kategori" 
                                            id="nama_kategori" type="text" value="{{old('nama_kategori', $kategori->nama_kategori)}}">
                                            @error('nama_kategori')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
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
        
    

    </body>

<!-- Mirrored from coderthemes.com/adminto/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 04 Feb 2024 04:13:20 GMT -->
</html>
@endsection