@extends('back.layout.template')
@section('title', Auth::user()->name . ' - Setting Profile')
@section('content')
            {{-- navbar  --}}
            @include('back.layout.navbar')
            {{-- end navbar  --}}
            <!-- sidebar  -->
            @include('back.layout.sidebar')
            <!-- sidebar end  -->
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Profile setting</h4>
                                <p class="sub-header">atur profile anda</p>
                                @if (session('success'))
                                <div class="my-3">
                                    <div class="alert alert-success">
                                        {{session('success')}} 
                                    </div> 
                                </div> 
                                @endif  
                                <form method="POST" enctype="multipart/form-data" id="profile_setup_frm" action="{{route('profile.update')}}" >
                                    @method('PUT')
                                    @csrf
                                    <input type="hidden" name="oldImg" value="{{ auth()->user()->foto }}">
                                    <div class="row">
                                                <div class="row" id="res"></div>
                                                <div class="row mt-2 mb-2">
                                                    <div class="col-md-6">
                                                        <label class="labels">Nama</label>
                                                        <input type="text" name="name" class="form-control" placeholder="first name" value="{{ auth()->user()->name }}" >
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="labels">Email</label>
                                                        <input type="email" name="email" disabled class="form-control" value="{{ auth()->user()->email }}" placeholder="Email" >
                                                    </div>
                                         
                                                </div>
                                                
                                                <div class="row mt-2">
                                                    <div class="col-md-6">
                                                        <label class="labels">Telepon</label>
                                                        <input type="number" name="telepon"  class="form-control" value="{{ auth()->user()->telepon }}" placeholder="Email" >
                                                    </div>
                                                   
                                                        <div class=" col-md-2" >
                                                            <label class="labels" for="btn">Level</label>
                                                            <button class="btn " id="btn" style="margin-top:-7px">
                                                                @if(Auth::user()->level == 'admin')
                                                            <span class="btn bg-success ">Admin</span>
                                                             @elseif(Auth::user()->level == 'petugas')
                                                            <span class="btn bg-warning ">Petugas</span>
                                                            @elseif(Auth::user()->level == 'pengguna')
                                                            <span class="btn bg-primary">Pengguna</span>
                                                            @else
                                                            <span class="btn bg-secondary">{{ Auth::user()->level }}</span>
                                                             @endif
                                                            </button>
    
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 ">
                                                        <label class="labels">Foto</label>
                                                        <input type="file" name="foto" class="form-control mb-2" id="img">                                                       
                                                        @if (auth()->user()->foto)
                                                        <small class="row" style="margin-left:5px">Foto lama:</small>
                                                        <img src="{{ asset('storage/fotoProfile/'.auth()->user()->foto) }}" alt="Foto Pengguna" 
                                                        class="img-thumbnail img-preview" width="100px">
                                                        
                                                    @else
                                                       <p>Foto Profile tidak ada</p>
                                                    @endif
                                                    </div>
                                                    
                                                </div>

                                             
                                                 
                                                <div class="mt-5 text-center">
                                                    <button id="btn" class="btn btn-primary profile-button" type="submit">Save Profile</button>
                                                    <a href="{{ route('redirect.dashboard') }}" class="btn btn-primary profile-button">kembali</a>
                                                </div>
                                            </div>
                                        </div>
                                         
                                    </div>   
                                            
                                        </form>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>



@include('back.layout.right')
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
@endsection