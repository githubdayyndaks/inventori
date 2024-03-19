@extends('back.layout.template')
@section('title', Auth::user()->name . ' - Tambah Peminjaman')
@section('content')
@push('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
@endpush
                     
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
                                            Tambah data Peminjaman
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
                                     

                                        <form id="form-tambah-barang" action="{{ url('peminjaman/simpan') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="id_user" value="{{ auth()->user()->id_user }}">
                                            <input type="hidden" name="tanggal_pinjam" id="tanggal_pinjam">
                                            <input type="hidden" name="tanggal_pengembalian" id="tanggal_pengembalian">
                                            <input type="hidden" name="_token" id="_token">
                                            <div class="row">
                                                <div class="mb-3 col-md-6">
                                                    <label for="barang">Pilih Barang</label>
                                                    <select name="nama_barang" id="barang" class="form-control">
                                                        <option value="" hidden>-- Pilih barang --</option>
                                                        @foreach ($barang as $item)
                                                            @if ($item->kondisi != 'rusak' && $item->kondisi != 'perbaikan')
                                                                <option value="{{ $item->kode_barang }}"
                                                                    data-kode_barang="{{ $item->kode_barang }}"
                                                                    data-kondisi="{{ $item->kondisi }}"
                                                                    data-merk="{{ $item->merk }}"
                                                                    data-bahan="{{ $item->bahan }}"
                                                                    data-ukuran="{{ $item->ukuran }}">
                                                                    {{ $item->nama_barang }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    @error('nama_barang')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                        
                                                <div class="mb-3 col-md-6">
                                                    <label for="nama_peminjam">Nama Peminjam</label>
                                                    <input class="input @error('nama_peminjam') is-invalid @enderror form-control"
                                                        name="nama_peminjam" id="nama_peminjam" type="text"
                                                        placeholder="Nama Peminjam" value="{{ old('nama_peminjam') }}">
                                                    @error('nama_peminjam')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                        
                                                <div class="mb-3 col-md-6">
                                                    <label for="jumlah_barang">Jumlah Barang</label>
                                                    <input min="1" class="input @error('jumlah_barang') is-invalid @enderror form-control"
                                                        name="jumlah_barang" id="jumlah_barang" type="number"
                                                        placeholder="Jumlah Barang" value="{{ old('jumlah_barang') }}">
                                                    @error('jumlah_barang')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="keterangan">Keterangan</label>
                                                    <textarea name="keterangan" id="keterangan" cols="30" rows="0" class="form-control">{{ old('keterangan') }}</textarea>
                                                    @error('keterangan')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <!-- Tambahkan input hidden untuk status -->
                                                <input type="hidden" name="status" value="proses">
            
                                                <div class="text-center">
                                                    <button type="button" id="btn-tambah" class="btn btn-primary">Tambah Barang</button>
                                                </div>
                                            </div>
                                        
                                            <!-- Hidden Input for Data Barang -->
                                            <input type="hidden" name="data_barang" id="data-barang" value="">
                                        
                                        </form>
                                        
            
                                        <!-- Tabel Sementara -->
                                        <div class="mt-4">
                                            <h4 class="header-title">Barang Sementara</h4>
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Barang</th>
                                                        <th>Kode Barang</th>
                                                        <th>Jumlah</th>
                                                        <th>Kondisi</th>
                                                        <th>Merk</th>
                                                        <th>Bahan</th>
                                                        <th>Ukuran</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tabel-sementara">
                                                    <!-- Data barang akan ditampilkan di sini -->
                                                </tbody>
                                            </table>
                                            <div>Total Jumlah: <span id="total-jumlah">0</span></div>
                                        </div>
                                        <!-- End Tabel Sementara -->
            
                                        <div class="text-center mt-3">
                                            <button type="button" id="btn-simpan" class="btn btn-success">Simpan Peminjaman</button>
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
        
        <script>
            $(document).ready(function() {
                // Inisialisasi Select2 pada dropdown #barang
                $('#barang').select2({
                    placeholder: '-- Pilih barang --',
                    allowClear: true,
                    width: '100%',
                    minimumInputLength: 1,
                    ajax: {
                        url: '{{ route("search.barang") }}',
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            return {
                                q: params.term
                            };
                        },
                        processResults: function(data) {
                            return {
                                results: $.map(data, function(item) {
                                    if (item.kondisi != 'rusak' && item.kondisi != 'perbaikan') {
                                        return {
                                            id: item.kode_barang,
                                            text: item.nama_barang,
                                            kode_barang: item.kode_barang,
                                            kondisi: item.kondisi,
                                            merk: item.merk,
                                            bahan: item.bahan,
                                            ukuran: item.ukuran
                                        };
                                    }
                                })
                            };
                        },
                        cache: true
                    }
                });
        
                const tambahButton = $("#btn-tambah");
                const tabelSementara = $("#tabel-sementara");
                const totalJumlahSpan = $("#total-jumlah");
                const simpanButton = $("#btn-simpan");
        
                let nomorBaris = 1;
                let totalJumlah = 0;
        
                tambahButton.on("click", function() {
                    const selectedBarang = $('#barang').find(':selected');
        
                    if (selectedBarang.length > 0) {
                        const namaBarangText = selectedBarang.text();
                        const kodeBarang = selectedBarang.val();
                        const kondisiBarang = selectedBarang.data('kondisi');
                        const merkBarang = selectedBarang.data('merk');
                        const bahanBarang = selectedBarang.data('bahan');
                        const ukuranBarang = selectedBarang.data('ukuran');
                        const jumlahBarang = $("#jumlah_barang").val();
        
                        if (jumlahBarang) {
                            const newRow = `
                                <tr>
                                    <td>${nomorBaris}</td>
                                    <td>${namaBarangText}</td>
                                    <td>${kodeBarang}</td>
                                    <td>${jumlahBarang}</td>
                                    <td>${kondisiBarang}</td>
                                    <td>${merkBarang}</td>
                                    <td>${bahanBarang}</td>
                                    <td>${ukuranBarang}</td>
                                    <td><button class="btn btn-danger hapus-barang">Hapus</button></td>
                                </tr>
                            `;
        
                            tabelSementara.append(newRow);
        
                            nomorBaris++;
                            totalJumlah += parseInt(jumlahBarang);
                            totalJumlahSpan.text(totalJumlah);
        
                            // Reset Form
                            $('#barang').val(null).trigger('change');
                            $("#jumlah_barang").val("");
                        } else {
                            alert("Silakan masukkan jumlah barang.");
                        }
                    } else {
                        alert("Silakan pilih barang terlebih dahulu.");
                    }
                });
        
                tabelSementara.on("click", ".hapus-barang", function() {
                    const row = $(this).closest("tr");
                    const jumlahBarang = parseInt(row.find("td:nth-child(4)").text());
                    totalJumlah -= jumlahBarang;
                    totalJumlahSpan.text(totalJumlah);
                    row.remove();
                });
        
                simpanButton.on("click", function() {
                    const dataBarang = [];
                    const keterangan = $("#keterangan").val(); // Dapatkan nilai bidang keterangan
        
                    // Validasi bidang keterangan
                    if (!keterangan) {
                        alert("Keterangan harus diisi!");
                        return; // Berhenti menjalankan fungsi jika keterangan kosong
                    }
        
                    // Lanjutkan dengan menambahkan data barang ke dalam array
                    tabelSementara.find("tr").each(function() {
                        const namaBarang = $(this).find("td:nth-child(2)").text();
                        const kodeBarang = $(this).find("td:nth-child(3)").text();
                        const jumlahBarang = $(this).find("td:nth-child(4)").text();
                        const kondisiBarang = $(this).find("td:nth-child(5)").text();
                        const merkBarang = $(this).find("td:nth-child(6)").text();
                        const bahanBarang = $(this).find("td:nth-child(7)").text();
                        const ukuranBarang = $(this).find("td:nth-child(8)").text();
                        const tanggalPinjam = new Date().toISOString().slice(0, 19).replace('T', ' ');
        
                        dataBarang.push({
                            nama_barang: namaBarang,
                            kode_barang: kodeBarang,
                            jumlah_barang: jumlahBarang,
                            kondisi: kondisiBarang, // Ubah 'kondisi_barang' menjadi 'kondisi'
                            merk: merkBarang,
                            bahan: bahanBarang,
                            ukuran: ukuranBarang
                        });
                    });
        
                    // Kirim dataBarang ke server menggunakan AJAX
                    $.ajax({
                        url: "{{ url('/peminjaman/simpan') }}",
                        type: "POST",
                        data: {
                            _token: '{{ csrf_token() }}',
                            nama_peminjam: $('#nama_peminjam').val(),
                            keterangan: keterangan, // Sertakan nilai bidang keterangan
                            data_barang: dataBarang,
                            status: 'proses' // Tambahkan input status
                        },
                        success: function(response) {
                            alert(response.message); // Tampilkan pesan dari respons JSON
                             window.location.href = response.peminjaman_url; 
            
                            // Kosongkan tabel sementara
                            tabelSementara.empty();
                    
                            // Reset nomor baris dan total jumlah
                            nomorBaris = 1;
                            totalJumlah = 0;
                            totalJumlahSpan.text(totalJumlah);
                    
                            // Redirect atau lakukan aksi lain setelah sukses simpan
                        },
        
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                            alert('Terjadi kesalahan saat menyimpan data.');
                        }
                    });
                });
        
            });
        </script>
        
        @endpush

    </body>

<!-- Mirrored from coderthemes.com/adminto/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 04 Feb 2024 04:13:20 GMT -->
</html>
@endsection