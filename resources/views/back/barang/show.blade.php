@extends('back.layout.template')
@section('title', Auth::user()->name . ' - Detail Barang')
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
                                            Detail data barang
                                        </p>

                                        <div class="mt-3">
                                            <table  class="table table-striped table-bordered">
                                              <thead>
                                              <tr>
                                                <th width="250px">kode_barang</th>
                                                <td>: {{$barang->kode_barang}}</td>
                                              </tr>
                                              <tr>
                                                <th>Nama barang</th>
                                                <td>: {{$barang->nama_barang}}</td>
                                              </tr>
                                              <tr>
                                                <th>Ruangan</th>
                                                <td>: {{$barang->ruangan->nama_ruangan}}</td>
                                              </tr>
                                              <tr>
                                                <th>Kategori</th>
                                                <td>: {{ $barang->kategori->nama_kategori}}</td>
                                              </tr>
                                              <tr>
                                                <th>Merk</th>
                                                <td>: {{ $barang->merk}}</td>
                                              </tr>
                                              <tr>
                                                <th>Jenis</th>
                                                <td>: {{ $barang->jenis}}</td>
                                              </tr>
                                              <tr>
                                                <th>Bahan</th>
                                                <td>: {{ $barang->bahan}}</td>
                                              </tr>
                                              <tr>
                                                <th>Ukuran</th>
                                                <td>: {{ $barang->ukuran}}</td>
                                              </tr>
                                              <tr>
                                                <th>Kondisi</th>
                                                <td>: {{ $barang->kondisi}}</td>
                                              </tr>
                                              <tr>
                                                <th>Tanggal barang di data</th>
                                                <td>: {{$barang->created_at}}</td>
                                              </tr>
                                              <tr>
                                                <th>Di data oleh</th>
                                                <td>: {{$barang->User->name}}</td>
                                              </tr>
                                              </thead>
                                              <tbody>
                                         
                                              </tbody>
                                            </table>
                                            <div class="float-end mb-3">
                                                <a href="{{url('barang')}}" class="btn btn-secondary">Back</a>
                                            </div>
                                        </div>
                                     



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
        
    {{-- ajax subkategori dan kategori  --}}
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