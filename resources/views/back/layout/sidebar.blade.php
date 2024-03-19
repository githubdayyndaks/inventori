          <!-- ========== Left Sidebar Start ========== -->
                   <!-- ========== Left Sidebar Start ========== -->
                   <?php
                   use Illuminate\Support\Facades\DB;
                   
                   // Lakukan query ke database untuk mengambil data setting
                   $setting = DB::table('setting')->first();
                   ?>
          <div class="left-side-menu">

<div class="h-100" data-simplebar>

     <!-- User box -->
    <div class="user-box text-center">
        

     {{-- <img src="{{ asset('storage/logo/'.$setting->path_logo) }}" alt="user-img" title="Mat Helme" class="rounded-circle img-thumbnail avatar-md"> --}}

            <div class="dropdown">
                <a href="#" class="user-name dropdown-toggle h5 mt-2 mb-1 d-block" data-bs-toggle="dropdown"  aria-expanded="false"> <?php echo Auth::user()->name?> |  <?php echo Auth::user()->level?></a>
                <div class="dropdown-menu user-pro-dropdown">

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-user me-1"></i>
                        <span>My Account</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-settings me-1"></i>
                        <span>Settings</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-lock me-1"></i>
                        <span>Lock Screen</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-log-out me-1"></i>
                        <span>Logout</span>
                    </a>

                </div>
            </div>

        {{-- <p class="text-muted left-user-info"><?php echo $setting->nama_sekolah?></p> --}}

        <ul class="list-inline">
            <li class="list-inline-item">
                <a href="#" class="text-muted left-user-info">
                    <i class="mdi mdi-cog"></i>
                </a>
            </li>

            <li class="list-inline-item">
                <a href="#">
                    <i class="mdi mdi-power"></i>
                </a>
            </li>
        </ul>
    </div>

    <!--- Sidemenu -->
    <div id="sidebar-menu">

        <ul id="side-menu">

            <li class="menu-title">Navigation</li>

            <li>
                <a href="{{url('/inventory/barang')}}">
                    <i class="mdi mdi-view-dashboard-outline"></i>
                    {{-- <span class="badge bg-success rounded-pill float-end">9+</span> --}}
                    <span> Dashboard </span>
                </a>
            </li>

            <li class="menu-title mt-2">Kelola data</li>
            @if (auth()->user()->level != 'pengguna')
            <li>
                <a href="{{url('ruangan')}}">
                    <i class="mdi mdi-room-service"></i>
                    <span> Ruangan </span>
                </a>
            </li>
      
            <li>
                <a href="{{url('kategori')}}">
                    <i class="mdi mdi-archive"></i>
                    <span> Kategori </span>
                </a>
            </li>
            <li>
                <a href="{{url('subkategori')}}">
                    <i class="mdi mdi-application"></i>
                    <span> subkategori </span>
                </a>
            </li>
            @endif
            <li>
                <a href="{{url('barang')}}">
                    <i class="mdi mdi-file-check"></i>
                    <span> data barang </span>
                </a>
            </li>
            @if (auth()->user()->level != 'pengguna')
            <li>
                <a href="#email" data-bs-toggle="collapse">
                    <i class="mdi mdi-location-enter"></i>
                    <span> barang masuk </span>
                </a>
            </li>

            <li>
                <a href="#sidebarTasks" data-bs-toggle="collapse">
                    <i class="mdi mdi-location-exit"></i>
                    <span> barang keluar </span>
                </a>
            </li>
            @endif
            <li class="menu-title mt-2">Apps</li>
            @if (auth()->user()->level == 'pengguna')
            <li>
                <a href="{{url('peminjaman')}}" >
                    <i class="mdi mdi-text-box-search"></i>
                    <span> Peminjamanku </span>
                </a>
            </li>
           @endif
           @if (auth()->user()->level != 'pengguna')
            <li>
                <a href="{{url('persetujuan')}}" >
                    <i class="mdi mdi-text-box-search"></i>
                    <span> Persetujuan Peminjaman barang </span>
                </a>
            </li>
           @endif
            <li class="menu-title mt-2">Pengaturan</li>

            <li>
                <a href="{{url('users')}}" >
                    <i class="mdi mdi-account-multiple-plus-outline"></i>
                    <span> User </span>
                </a>
            </li>
            @if (auth()->user()->level != 'pengguna')
    <li>
        
        <a href="{{ url('setting') }}">
            <i class="mdi mdi-cog"></i>
            <span>Setting</span>
        </a>
    </li>
    @endif
        </ul>

    </div>
    <!-- End Sidebar -->

    <div class="clearfix"></div>

</div>
<!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->