@extends('back.layout.template')
@section('title', Auth::user()->name . ' - Edit Barang')
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
                                        <h4 class="mt-0 header-title">Barang</h4>
                                        <p class="text-muted font-14 mb-3">
                                            Edit data Barang
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
                                     

                                        <form action="{{url('barang/'.$barang->kode_barang)}}" method="POST" enctype="multipart/form-data">
                                            @method('PUT')
                                            @csrf
                                       <div class="row">
                                        <div class=" mb-3 col-md-12">
                                            <label for="kode_ruangan">Kode barang</label>
                              <input class="input @error('kode_barang') is-invalid @enderror form-control" name="kode_barang" readonly id="kode_barang" 
                              type="text" value="{{old('barang', $barang->kode_barang)}}">

                                            @error('kode_barang')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                            <label for="nama_barang">Nama barang</label>
                                            <input type="text" class="form-control" id="nama_barang" name="nama_barang"
                                            value="{{old('nama_barang', $barang->nama_barang)}}">
                                            @error('nama_barang')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                        </div>
                                        </div>

                                        <div class=" mb-3 col-md-12">
                                            <label for="nama_ruangan">Ruangan</label>
                                         <select name="kode_ruangan" id="kode_ruangan" class="form-control">
                                            @foreach ($ruangan as $item)
                                                <option value="{{$item->kode_ruangan}}" @if($barang->kode_ruangan == $item->kode_ruangan) selected @endif>{{$item->nama_ruangan}}</option>
                                            @endforeach
                                        </select>
                                            @error('kode_ruangan')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="nama_kategori">Kategori</label>
                                                <select name="kode_kategori" id="nama_kategori" class="form-control">
                                                    <option value="" hidden>-- Pilih Kategori --</option>
                                                    @foreach ($kategori as $item)
                                                        <option value="{{$item->kode_kategori}}" @if($barang->kategori->kode_kategori == $item->kode_kategori) selected @endif>{{$item->nama_kategori}}</option>
                                                    @endforeach
                                                </select>
                                                @error('kode_kategori')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="nama_subkategori">Subkategori</label>
                                                <select name="kode_subkategori" id="nama_subkategori" class="form-control">
                                                    <option value="" hidden>-- Pilih Subkategori --</option>
                                                    @foreach ($subkategori as $item)
                                                        <option value="{{$item->kode_subkategori}}" data-merk="{{$item->merk}}" data-jenis="{{$item->jenis}}" @if($barang->kode_subkategori == $item->kode_subkategori) selected @endif>{{$item->nama_subkategori}}</option>
                                                    @endforeach
                                                </select>
                                                @error('kode_subkategori')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="merk">Merk</label>
                                                <input type="text" name="merk" id="merk" class="form-control" value="{{$barang->merk}}" readonly>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="jenis">Jenis</label>
                                                <input type="text" name="jenis" id="jenis" class="form-control" value="{{$barang->jenis}}" readonly>
                                            </div>
                                        </div>
                                        

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                            <label for="bahan">Bahan</label>
                                            <input type="text" class="form-control" id="bahan" name="bahan"
                                            value="{{old('bahan', $barang->bahan)}}">
                                            @error('bahan')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                        </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                            <label for="ukuran">Ukuran</label>
                                            <input type="text"  class="form-control" id="ukuran" name="ukuran"
                                            value="{{old('ukuran', $barang->ukuran)}}">
                                            @error('ukuran')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                        </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="kondisi">Kondisi</label>
                                                <select name="kondisi" id="kondisi" class="form-control">
                                                    <option value="baik" @if(old('kondisi', $barang->kondisi) == 'baik') selected @endif>Baik</option>
                                                    <option value="perbaikan" @if(old('kondisi', $barang->kondisi) == 'perbaikan') selected @endif>Sedang diperbaiki</option>
                                                    <option value="rusak" @if(old('kondisi', $barang->kondisi) == 'rusak') selected @endif>Rusak</option>
                                                </select>
                                                @error('kondisi')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="text-center">
                                           <a href="{{url('barang')}}" class="btn btn-light">kembali</a>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('#nama_kategori').change(function(){
            var kode_kategori = $(this).val();
            if(kode_kategori){
                $.ajax({
                    type:"GET",
                    url:"{{url('get-subkategori')}}/"+kode_kategori,
                    success:function(res){               
                        if(res){
                            $("#nama_subkategori").empty();
                            $("#nama_subkategori").append('<option value="" hidden>-- Pilih Subkategori --</option>');
                            $.each(res,function(key,value){
                                $("#nama_subkategori").append('<option value="'+value.kode_subkategori+'" data-merk="'+value.merk+'" data-jenis="'+value.jenis+'">'+value.nama_subkategori+'</option>');
                            });
                        }else{
                           $("#nama_subkategori").empty();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }else{
                $("#nama_subkategori").empty();
            }
        });
    });
</script>


{{-- ajax merk dan jenis  --}}
<script>
    $(document).ready(function(){
        $('#nama_subkategori').change(function(){
            var selectedOption = $(this).find('option:selected');
            var merk = selectedOption.attr('data-merk');
            var jenis = selectedOption.attr('data-jenis');
            $('#merk').val(merk);
            $('#jenis').val(jenis);
        });
    });
</script>

@endpush



    </body>

<!-- Mirrored from coderthemes.com/adminto/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 04 Feb 2024 04:13:20 GMT -->
</html>
@endsection