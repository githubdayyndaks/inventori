@extends('back.layout.template')
@section('title', Auth::user()->name . ' - Peminjaman barang')
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
                                            Kelola Data Peminjaman
                                        </p>
                                        
                                        {{-- <a href="{{url('peminjaman/create')}}" class="btn btn-primary mb-2">
                                            <span class="icon"><i class="mdi mdi-pencil"></i></span> Tambah Peminjaman</a>
                                    --}}
    
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
                                     

                                        <table id="responsive-datatable" class="table table-bordered table-bordered dt-responsive nowrap">
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama peminjam</th>
                                                <th>Nama barang</th>
                                                <th>Jumlah Barang</th>
                                                <th>Kondisi</th>
                                                <th>Tanggal Pinjam</th>
                                                <th>Tanggal Pengembalian</th>
                                                <th>status</th>

                                                <th>Function</th>
                                      
                                            </tr>
                                            </thead>
                                            <tbody>
                                       {{-- @dd($ruangan); --}}
                                       @foreach ($peminjaman as $index => $item)
                                       <tr>
                                           <td>{{ $index + 1 }}</td>
                                           <td>{{ $item->nama_peminjam}}</td>
                                           <td>{{$item->nama_barang}}</td>
                                           <td>{{ $item->jumlah_barang }}</td>
                                           <td>{{ $item->kondisi }}</td>
                                           <td>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d-m-Y H:i:s') }}</td>
                                           <td>
                                               @if ($item->status == 'dikembalikan')
                                                   {{$item->tanggal_pengembalian}}
                                               @endif
                                           </td>
                                           
                                           <td>{{ $item->status }}</td>
                                           <td class="text-center">
                                               
                                                       {{-- <!-- Tombol Edit -->
   @if(auth()->user()->isAdmin() || auth()->user()->isPetugas() || $item->id_user === auth()->user()->id_user)
   <a href="{{ url('peminjaman/'.$item->id_peminjam.'/edit') }}" class="btn btn-warning mb-2">
       <span class="icon"><i class="mdi mdi-pencil"></i></span> Edit
   </a>
@endif

<!-- Tombol Delete -->
@if(auth()->user()->isAdmin() || auth()->user()->isPetugas() || $item->id_user === auth()->user()->id_user)
   <a href="#" onclick="deletePeminjaman(this)" data-id="{{ $item->id_peminjam }}"  class="btn btn-danger mb-2">
       <span class="icon"><i class="mdi mdi-trash-can"></i></span> Delete
   </a>
@endif --}}


                                               <a href="{{ url('peminjaman/'.$item->id_peminjam) }}" class="btn btn-info mb-2">
                                                   <span class="icon"><i class="mdi mdi-eye"></i></span> Detail
                                               </a>    
                                               
                                          
                                               <!-- Tombol Kembalikan hanya ditampilkan saat status peminjaman adalah 'Dipinjam' -->
                                               <a class="btn btn-info mb-2 kembalikan-btn" data-id-peminjam="{{ $item->id_peminjam }}">
                                                   <span class="icon"><i class="mdi mdi-eye"></i></span> Kembalikan
                                               </a>
                                               
                                      
                                           
                                           </td>
                                       </tr>
                                       @endforeach
                                            </tbody>
                                        </table>
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
       <script src="{{asset('Admin/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
       <script src="{{asset('Admin/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js')}}"></script>
       <script src="{{asset('Admin/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
       <script src="{{asset('Admin/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js')}}"></script>
       <script src="{{asset('Admin/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
       <script src="{{asset('Admin/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js')}}"></script>
       <script src="{{asset('Admin/libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
       <script src="{{asset('Admin/libs/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
       <script src="{{asset('Admin/libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
       <script src="{{asset('Admin/libs/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
       <script src="{{asset('Admin/libs/datatables.net-select/js/dataTables.select.min.js')}}"></script>
       <script src="{{asset('Admin/libs/pdfmake/build/pdfmake.min.js')}}"></script>
       <script src="{{asset('Admin/libs/pdfmake/build/vfs_fonts.js')}}"></script>
       
       <script src="{{asset('Admin/js/pages/datatables.init.js')}}"></script>

       <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
       <script src="https://code.jquery.com/jquery-3.7.0.js"></script>

       <script>
        const swal = $('.swal').data('swal');
    
        function deletePeminjaman(e) {
        let id_peminjam = e.getAttribute('data-id');
        console.log("ID Peminjaman yang Dihapus:", id_peminjam);
    
        Swal.fire({
            title: 'Delete Peminjaman',
            text: "Are you sure?",
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Delete',
            cancelButtonText: 'Cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'DELETE',
                    url: '/peminjaman/' + id_peminjam,
                    dataType: "json",
                    success: function (response) {
                        Swal.fire({
                            title: "Success",
                            text: response.message,
                            icon: 'success',
                        }).then((result) => {
                            window.location.href = '/peminjaman';
                        });
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
            }
        });
    }
    
      </script>
       @endpush

 {{-- sweetalert2  --}}
 

    </body>

<!-- Mirrored from coderthemes.com/adminto/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 04 Feb 2024 04:13:20 GMT -->
</html>
@endsection