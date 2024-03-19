@extends('back.layout.template')
@section('title', Auth::user()->name . ' - Setting Inventory barang')
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
                                        <h4 class="mt-0 header-title">Setting</h4>
                                        <p class="text-muted font-14 mb-3">
                                            Setting informasi sekolah
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
                                    
                                        @if (session('success'))
                                        <div class="my-3">
                                            <div class="alert alert-success">
                                                {{session('success')}} 
                                            </div> 
                                        </div> 
                                        @endif
                                     

                                        <form action="{{url('setting/'.$setting->id_setting)}}" method="POST" enctype="multipart/form-data">
                                            @method('PUT')
                                            @csrf
                                       <div class="row">
                                        <div class="mb-3 col-md-12">
                                            <label for="img">Logo Sekolah</label>
                                            <input type="file" name="path_logo" id="img" class="form-control mb-2" >                                                       
                                            @empty($setting->path_logo)
                                                <p>Logo Sekolah tidak ada</p>
                                            @else
                                                <div class="mt-2" >
                                                    <small class="row" style="margin-left:5px">logo lama:</small>
                                                    <img src="{{ asset('storage/logo/'.$setting->path_logo) }}" class="img-thumbnail img-preview" alt="Foto Pengguna" width="120px">                              
                                                </div>
                                            @endempty
                                        </div>
                                        <div class=" mb-3 col-md-12">
                                            <label for="npsn">NPSN</label>
                                          <input name="npsn" id="" cols="10" rows="10" class=" @error('npsn') is-invalid @enderror form-control"
                                          id="npsn" value="{{old('npsn', $setting->npsn)}}" >
                                       
                                          @error('npsn')
                                          <div class="invalid-feedback">
                                              {{$message}}
                                          </div>
                                      @enderror
                                        </div>

                                        <div class=" mb-3 col-md-12">
                                            <label for="nama_sekolah">Nama Sekolah</label>
                                            <input class="input @error('nama_sekolah') is-invalid @enderror form-control" name="nama_sekolah" 
                                            id="nama_sekolah" type="text" value="{{old('nama_sekolah', $setting->nama_sekolah)}}">
                                            @error('nama_sekolah')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                        </div>

                                

                                        <div class=" mb-3 col-md-12">
                                            <label for="email">Email</label>
                                          <input name="email" id="" cols="10" rows="10" class=" @error('email') is-invalid @enderror form-control" type="email"
                                          id="email" value="{{old('email', $setting->email)}}" >
                                       
                                          @error('email')
                                          <div class="invalid-feedback">
                                              {{$message}}
                                          </div>
                                      @enderror
                                        </div>

                                        <div class=" mb-3 col-md-12">
                                            <label for="telepon">Telepon Sekolah</label>
                                            <input class="input @error('telepon') is-invalid @enderror form-control" name="telepon" 
                                            id="telepon" type="text" value="{{old('telepon', $setting->telepon)}}">
                                            @error('telepon')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class=" mb-3 col-md-12">
                                            <label for="website">website</label>
                                          <input name="website" id="" cols="10" rows="10" class=" @error('website') is-invalid @enderror form-control"
                                          id="website" value="{{old('website', $setting->website)}}" >
                                       
                                          @error('website')
                                          <div class="invalid-feedback">
                                              {{$message}}
                                          </div>
                                      @enderror
                                        </div>

                                        <div class=" mb-3 col-md-12">
                                            <label for="provinsi">provinsi</label>
                                          <select name="provinsi" id="provinsi" class="form-control">
                                            <option value="{{ $setting->id }}" {{ $setting->id == $setting->provinsi ? 'selected' : '' }}>
                                                {{ $setting->provinsi }}
                                            </option>
                                          </select>
                                       
                                          @error('provinsi')
                                          <div class="invalid-feedback">
                                              {{$message}}
                                          </div>
                                      @enderror
                                        </div>

                                        <div class=" mb-3 col-md-12">
                                            <label for="kabkot">Kab/Kota</label>
                                            <select name="kabkot" id="kabkot" class="form-control">
                                                <option value="{{old('kabkot', $setting->kabkot)}}"></option>
                                              </select>
                                          @error('kabkot')
                                          <div class="invalid-feedback">
                                              {{$message}}
                                          </div>
                                      @enderror
                                        </div>

                                        <div class=" mb-3 col-md-12">
                                            <label for="kecamatan">kecamatan</label>
                                            <select name="kecamatan" id="kecamatan" class="form-control">
                                                <option value="{{old('kecamatan', $setting->kecamatan)}}"></option>
                                              </select>
                                          @error('kecamatan')
                                          <div class="invalid-feedback">
                                              {{$message}}
                                          </div>
                                      @enderror
                                        </div>

                                        <div class=" mb-3 col-md-12">
                                            <label for="kelurahan">kelurahan</label>
                                            <select name="kelurahan" id="kelurahan" class="form-control">
                                                <option value="{{old('kelurahan', $setting->kelurahan)}}"></option>
                                              </select>
                                          @error('kelurahan')
                                          <div class="invalid-feedback">
                                              {{$message}}
                                          </div>
                                      @enderror
                                        </div>

                                        <div class=" mb-3 col-md-12">
                                            <label for="jalan">Jalan</label>
                                          <input name="jalan" id="" cols="10" rows="10" class=" @error('jalan') is-invalid @enderror form-control"
                                          id="jalan" value="{{old('jalan', $setting->jalan)}}" >
                                       
                                          @error('jalan')
                                          <div class="invalid-feedback">
                                              {{$message}}
                                          </div>
                                      @enderror
                                        </div>

                                        <div class=" mb-3 col-md-12">
                                            <label for="kodepos">Kode Pos</label>
                                          <input name="kodepos" id="" cols="10" rows="10" class=" @error('kodepos') is-invalid @enderror form-control"
                                          id="kodepos" value="{{old('kodepos', $setting->kodepos)}}" >
                                       
                                          @error('kodepos')
                                          <div class="invalid-feedback">
                                              {{$message}}
                                          </div>
                                      @enderror
                                        </div>

                                        <div class="text-center">
                                            <a href="{{ route('redirect.dashboard') }}" class="btn btn-secondary">Kembali ke dashboard</a>
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
       {{-- API wilayah indonesia  --}}
       <script>
        fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/provinces.json`)
        .then(response => response.json())
        .then(provinces =>{
            var data = provinces;
            var tampung = '<option>Pilih</option>';
            document.getElementById('kabkot').innerHTML = '<option>{{$setting->kabkot}}<option>';
                document.getElementById('kecamatan').innerHTML = '<option>{{$setting->kecamatan}}<option>';
                document.getElementById('kelurahan').innerHTML = '<option>{{$setting->kelurahan}}<option>';
            data.forEach(element => {
                tampung += `<option data-reg="${element.id}" value="${element.name}" ${element.name == '{{ $setting->provinsi }}' ? 'selected' : ''}>${element.name}</option>`
            });
            document.getElementById('provinsi').innerHTML = tampung;
        })
    </script>
    <script>
        const selectProvinsi = document.getElementById('provinsi');
        selectProvinsi.addEventListener('change', (e) => {
            var provinsi = e.target.options[e.target.selectedIndex].dataset.reg;
            fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/regencies/${provinsi}.json`)
            .then(response => response.json())
            .then(regencies =>{
                var data = regencies;
                var tampung = '<option>Pilih</option>';
                document.getElementById('kabkot').innerHTML = '<option>Pilih<option>';
                document.getElementById('kecamatan').innerHTML = '<option>Pilih<option>';
                document.getElementById('kelurahan').innerHTML = '<option>Pilih<option>';
                data.forEach(element => {
                    tampung += `<option data-dist="${element.id}"
                     value="${element.name}" ${element.name == '{{ $setting->kabkot }}' ? 'selected' : ''}>${element.name}</option>`
                });
                document.getElementById('kabkot').innerHTML = tampung;
            });
        });
    
        const selectKota = document.getElementById('kabkot');
        selectKota.addEventListener('change', (e) => {
            var kabkot = e.target.options[e.target.selectedIndex].dataset.dist;
            fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/districts/${kabkot}.json`)
            .then(response => response.json())
            .then(districts =>{
                var data = districts;
                var tampung = '<option>Pilih</option>';
                document.getElementById('kecamatan').innerHTML = '<option>Pilih<option>';
                document.getElementById('kelurahan').innerHTML = '<option>Pilih<option>';
                data.forEach(element => {
                    tampung += `<option data-vill="${element.id}"
                     value="${element.name}" ${element.name == '{{ $setting->kecamatan }}' ? 'selected' : ''}>${element.name}</option>`
                });
                document.getElementById('kecamatan').innerHTML = tampung;
            });
        });
    
        const selectKecamatan = document.getElementById('kecamatan');
        selectKecamatan.addEventListener('change', (e) => {
            var kecamatan = e.target.options[e.target.selectedIndex].dataset.vill;
            fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/villages/${kecamatan}.json`)
            .then(response => response.json())
            .then(villages =>{
                var data = villages;
                var tampung = '<option>Pilih</option>';
                document.getElementById('kelurahan').innerHTML = '<option>Pilih<option>';
                data.forEach(element => {
                    tampung += `<option value="${element.name}" ${element.name == '{{ $setting->kelurahan }}' ? 'selected' : ''}>${element.name}</option>`
                });
                document.getElementById('kelurahan').innerHTML = tampung;
            });
        });
    </script>
    
       {{-- menampilkan preview img  --}}
            <script>
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