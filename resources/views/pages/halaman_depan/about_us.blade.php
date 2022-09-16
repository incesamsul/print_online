@extends('layouts_halaman_depan.template')

@section('content')
<section class="breadcrumb-section pb-3 pt-3">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">About</a></li>
        </ol>
    </div>
</section>

<section class="other-products pb-4 pt-4">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <div class="section-title table-responsive">
                    <h2>About Us</h2>
                    <img class="mt-4" src="{{ asset('/img/png/unitama.png') }}" alt="" width="200">
                    <p class="my-4">Universitas Teknologi Akba Makassar</p>
                    <p>Made by <i class="fa fa-heart text-danger"></i> By Hastin</p>
                </div>
            </div>
            <div class="col-sm-4">
              <div class="section-title">
                  <h2>Info</h2>
                  <table class="table">
                    <tr>
                        <th>Jl. perintis kemerdekaan</th>
                    </tr>
                    <tr>
                        <th> akba.ac.id</th>
                    </tr>
                    <tr>
                       <th> Unggul dan kompetitif</th>
                  </tr>
                </table>
              </div>
          </div>
        </div>
        <div class="row mt-4">

        </div>
    </div>
</section>



  <!-- Modal -->
  <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalLabel">ganti foto profile</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-12 d-flex flex-column justify-content-center align-items-center">
                    <img id="preview" src="{{ auth()->user()->foto == "" ? asset('stisla/assets/img/avatar/avatar-1.png') : asset('data/foto_profile/'.auth()->user()->foto . '/'. auth()->user()->foto) }}" alt="" class="rounded-circle mb-2" width="100">
                    <label for="ket_simulator">Ganti foto profile</label>
                    <div class="custom-file">
                        <form action="{{ URL::to('/ubah_foto_profile') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                        <input accept="image/*" wire:model='photo' required type="file" class="custom-file-input" id="customFile" name="foto" onchange="loadFile(event)">
                        <label class="custom-file-label" for="customFile">Pilih File</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Ganti</button>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('script')
<script>

    var loadFile = function(event){
        var output = document.querySelector('#preview');
        output.src = URL.createObjectURL(event.target.files[0]);
    }
    $('.btn-preview').on('click', function() {
        let path = $(this).data('path');
        $('#iframe-preview').attr('src',path);
    })
    $('#liDashboard').addClass('active');

</script>
@endsection
