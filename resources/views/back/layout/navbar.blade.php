       <!-- Topbar Start -->
       <div class="navbar-custom">
        <ul class="list-unstyled topnav-menu float-end mb-0">

            <li class="d-none d-lg-block">
                    <form class="app-search">
                    <div class="app-search-box">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search..." id="top-search">
                            <button class="btn input-group-text" type="submit">
                                <i class="fe-search"></i>
                            </button>
                        </div>
                        <div class="dropdown-menu dropdown-lg" id="search-dropdown">
                            <!-- item-->
                            <div class="dropdown-header noti-title">
                                <h5 class="text-overflow mb-2">Found 22 results</h5>
                            </div>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="fe-home me-1"></i>
                                <span>Analytics Report</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="fe-aperture me-1"></i>
                                <span>How can I help you?</span>
                            </a>
                
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="fe-settings me-1"></i>
                                <span>User profile settings</span>
                            </a>

                            <!-- item-->
                            <div class="dropdown-header noti-title">
                                <h6 class="text-overflow mb-2 text-uppercase">Users</h6>
                            </div>

                            <div class="notification-list">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="d-flex align-items-start">
                                        <img class="d-flex me-2 rounded-circle" src="assets/images/users/user-2.jpg" alt="Generic placeholder image" height="32">
                                        <div class="w-100">
                                            <h5 class="m-0 font-14">Erwin E. Brown</h5>
                                            <span class="font-12 mb-0">UI Designer</span>
                                        </div>
                                    </div>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="d-flex align-items-start">
                                        <img class="d-flex me-2 rounded-circle" src="assets/images/users/user-5.jpg" alt="Generic placeholder image" height="32">
                                        <div class="w-100">
                                            <h5 class="m-0 font-14">Jacob Deo</h5>
                                            <span class="font-12 mb-0">Developer</span>
                                        </div>
                                    </div>
                                </a>
                            </div>

                        </div> 
                    </div>
                </form>
            </li>

            <li class="dropdown d-inline-block d-lg-none">
                <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="fe-search noti-icon"></i>
                </a>
                <div class="dropdown-menu dropdown-lg dropdown-menu-end p-0">
                    <form class="p-3">
                        <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                    </form>
                </div>
            </li>

            <li class="dropdown notification-list topbar-dropdown">
                <a class="nav-link dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="fe-bell noti-icon"></i>
                    <span class="badge bg-danger rounded-circle noti-icon-badge" id="jumlahNotifikasi">
                        <script>
                            var jumlahNotifikasi = {{ \App\Models\Notification::count() }};
                            document.write(jumlahNotifikasi);
                        </script>
                        
                    </span>
                    
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-lg">

                    <!-- item-->
                    <div class="dropdown-item noti-title">
                        <h5 class="m-0">
                            <span class="float-end">
                                <a href="#" class="text-dark">
                                    <small onclick="hapusSemuaNotifikasi()">Clear All</small>

                                </a>
                            </span>Notification
                        </h5>
                    </div>
                    <style>
                        .dropdown-item.notify-item:hover {
                            background-color: #f8f9fa;
                        }
                    
                        .dropdown-item.notify-item.unread {
                            background-color: #e9ecef;
                        }
                    </style>
                    
             
        {{-- resources/views/notifications.blade.php --}}
        <div class="noti-scroll" data-simplebar>
            @foreach(\App\Models\Notification::all() as $notification)
                <div class="dropdown-item notify-item">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <i class="mdi mdi-alert-circle-outline text-primary mr-2"></i>
                        </div>
                        <div class="col-auto">
                            <p class="mb-0">{{ $notification->message }}</p>
                            <!-- Tambahkan kolom tanggal_pinjam jika diperlukan -->
                            <!-- <p id="infoPeminjaman_{{ $notification->id }}" class="mb-0 text-muted">Peminjaman pada tanggal {{ $notification->tanggal_pinjam }}</p> -->
                        </div>
                        <div class="col-auto">
                            <!-- Tombol Hapus -->
                            @if (auth()->user()->level != 'pengguna')
                            <a href="{{url('persetujuan')}}" class="text-dark">
                            @endif
                                <small>{{$notification->created_at}}</small> <br>
                                <small onclick="hapusNotifikasi('{{ $notification->id }}')">Hapus</small>

                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        

                    

<!-- Tombol Hapus Semua -->




                                            
                                        

            </li>

            <li class="dropdown notification-list topbar-dropdown">
                <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <img src="{{ asset('storage/fotoProfile/'.auth()->user()->foto) }}" alt="foto Profile" class="rounded-circle">
                    <span class="pro-user-name ms-1">
                        <?php echo Auth::user()->name?> |  <?php echo Auth::user()->level?><i class="mdi mdi-chevron-down"></i> 
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                    <!-- item-->
                    <div class="dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Welcome !</h6>
                    </div>

                    <!-- item-->
                    <a href="/profile" class="dropdown-item notify-item">
                        <i class="fe-user"></i>
                        <span>Profile</span>
                    </a>

                    <!-- item-->
                    <a href="auth-lock-screen.html" class="dropdown-item notify-item">
                        <i class="fe-lock"></i>
                        <span>Lock Screen</span>
                    </a>

                    <div class="dropdown-divider"></div>

                    <!-- item-->
                    <a href="/logout" class="dropdown-item notify-item">
                        <i class="fe-log-out"></i>
                        <span>Logout</span>
                    </a>

                </div>
            </li>

            <li class="dropdown notification-list">
                <a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect waves-light">
                    <i class="fe-settings noti-icon"></i>
                </a>
            </li>

        </ul>

        <!-- LOGO -->
        <div class="logo-box">
            <a href="index.html" class="logo logo-light text-center">
                <span class="logo-sm">
                    <img src="assets/images/logo-sm.png" alt="" height="22">
                </span>
                <span class="logo-lg">
                    <img src="assets/images/logo-light.png" alt="" height="16">
                </span>
            </a>
            <a href="index.html" class="logo logo-dark text-center">
                <span class="logo-sm">
                    <img src="assets/images/logo-sm.png" alt="" height="22">
                </span>
                <span class="logo-lg">
                    <img src="assets/images/logo-dark.png" alt="" height="16">
                </span>
            </a>
        </div>

        <ul class="list-unstyled topnav-menu topnav-menu-left mb-0">
            <li>
                <button class="button-menu-mobile disable-btn waves-effect">
                    <i class="fe-menu"></i>
                </button>
            </li>

            <li>
                <h4 class="page-title-main">Dashboard</h4>
            </li>

        </ul>

        <div class="clearfix"></div> 
   
</div>
<!-- end Topbar -->

@push('js')
<script>
    function hapusNotifikasi(id) {
        if (confirm('Apakah Anda yakin ingin menghapus notifikasi ini?')) {
            $.ajax({
                url: '/hapus-notifikasi/' + id,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // Refresh atau perbarui tampilan notifikasi setelah berhasil menghapus
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }
    }
</script>
<script>
    function hapusSemuaNotifikasi() {
        if (confirm('Apakah Anda yakin ingin menghapus semua notifikasi?')) {
            var token = document.head.querySelector('meta[name="csrf-token"]').content;

            $.ajax({
                url: '/hapus-semua-notifikasi',
                type: 'DELETE',
                data: {
                    _token: token
                },
                success: function(response) {
                    // Refresh atau perbarui tampilan notifikasi setelah berhasil menghapus semua notifikasi
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }
    }
</script>


<script>
    $(document).ready(function() {
        // Panggil fungsi ini ketika notifikasi dibaca
        function notifikasiDibaca() {
            var jumlahNotifikasi = parseInt($('.noti-icon-badge').text());
            if (jumlahNotifikasi > 0) {
                jumlahNotifikasi--;
                $('.noti-icon-badge').text(jumlahNotifikasi);
                // Simpan jumlah notifikasi baru di dalam session
                $.ajax({
                    url: '{{ route("update.notification.count") }}',
                    method: 'POST',
                    data: {
                        jumlah_notifikasi: jumlahNotifikasi,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // Handle response jika diperlukan
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        }

        // Panggil fungsi notifikasiDibaca() ketika notifikasi di-klik atau dibaca
        $('.dropdown-item.notify-item').click(function() {
            // Lakukan tindakan yang diperlukan saat notifikasi di-klik atau dibaca
            // ...
            // Panggil fungsi untuk mengurangi jumlah notifikasi
            notifikasiDibaca();
        });
    });
</script>

@endpush