@extends('back.layout.template')
@section('title', Auth::user()->name . ' - Edit Peminjaman')
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
                                        <h4 class="mt-0 header-title">Peminjaman</h4>
                                        <p class="text-muted font-14 mb-3">
                                            Edit data Peminjaman
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
                                     

                                        <form action="{{url('peminjaman/'.$peminjaman->id_peminjam)}}" method="POST" enctype="multipart/form-data">
                                            @method('PUT')
                                            @csrf
                                        <input type="hidden" name="id_user" value="{{$peminjaman->id_user}}">
                                        <input type="hidden" name="status" value="proses">
                                       <div class="row">
                                        <div class=" mb-3 col-md-6">
                                            <label for="nama_peminjam">Nama Peminjam</label>
                                            <input class="input @error('nama_peminjam') is-invalid @enderror form-control" name="nama_peminjam" 
                                            id="nama_peminjam" type="text" value="{{old('nama_peminjam', $peminjaman->nama_peminjam)}}" readonly>
                                            @error('nama_peminjam')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class=" mb-3 col-md-6">
                                            <label for="nama_barang">Nama Barang</label>
                                            <input class="input @error('nama_barang') is-invalid @enderror form-control" name="nama_barang" 
                                            id="nama_barang" type="text" value="{{old('nama_barang', $peminjaman->nama_barang)}}" readonly>
                                            @error('nama_barang')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class=" mb-3 col-md-6">
                                            <label for="nama_peminjam">Tanggal Pinjam</label>
                                            <input class="input @error('tanggal_pinjam') is-invalid @enderror form-control" name="tanggal_pinjam" 
                                            id="tanggal_pinjam" type="text" value="{{old('tanggal_pinjam', $peminjaman->tanggal_pinjam)}}" readonly>
                                            @error('tanggal_pinjam')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class=" mb-3 col-md-6">
                                            <label for="nama_barang">Merk</label>
                                            <input class="input @error('merk') is-invalid @enderror form-control" name="merk" 
                                            id="merk" type="text" value="{{old('merk', $peminjaman->merk)}}" readonly>
                                            @error('merk')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class=" mb-3 col-md-6">
                                            <label for="nama_barang">Bahan</label>
                                            <input class="input @error('bahan') is-invalid @enderror form-control" name="bahan" 
                                            id="bahan" type="text" value="{{old('bahan', $peminjaman->bahan)}}" readonly>
                                            @error('bahan')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class=" mb-3 col-md-6">
                                            <label for="ukuran">ukuran</label>
                                            <input class="input @error('ukuran') is-invalid @enderror form-control" name="ukuran" 
                                            id="ukuran" type="text" value="{{old('ukuran', $peminjaman->ukuran)}}" readonly>
                                            @error('ukuran')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class=" mb-3 col-md-6">
                                            <label for="nama_barang">kondisi</label>
                                            <input class="input @error('kondisi') is-invalid @enderror form-control" name="kondisi" 
                                            id="kondisi" type="text" value="{{old('kondisi', $peminjaman->kondisi)}}" readonly>
                                            @error('kondisi')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class=" mb-3 col-md-6">
                                            <label for="jumlah_barang">Jumlah barang</label>
                                            <input min="1" class="input @error('jumlah_barang') is-invalid @enderror form-control" name="jumlah_barang" 
                                            id="jumlah_barang" type="number" value="{{old('jumlah_barang', $peminjaman->jumlah_barang)}}" >
                                            @error('jumlah_barang')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class=" mb-3 col-md-6">
                                            <label for="jumlah_barang">Keterangan</label>
                                            <textarea name="keterangan" id="" cols="100" rows="0" class="form-control">{{old('keterangan', $peminjaman->keterangan)}}</textarea>
                                            @error('jumlah_barang')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    <div class="text-center">
                                        <a href="{{url('peminjaman')}}" class="btn btn-info">Kembali</a>
                                        <button type="submit" class="btn btn-primary">Simpan perubahan</button>
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
        
    
<!-- Script untuk mengisi nilai tanggal secara otomatis -->
{{-- <script>
    // Fungsi untuk mengisi nilai tanggal saat tombol submit ditekan
    function isiTanggalOtomatis() {
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();

        today = yyyy + '-' + mm + '-' + dd;
        document.getElementById('tanggal_pinjam').value = today;
    }

    // Mendaftarkan fungsi ke event 'submit' pada form
    document.querySelector('form').addEventListener('submit', function() {
        isiTanggalOtomatis();
    });
</script> --}}

    </body>

<!-- Mirrored from coderthemes.com/adminto/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 04 Feb 2024 04:13:20 GMT -->
</html>
@endsection