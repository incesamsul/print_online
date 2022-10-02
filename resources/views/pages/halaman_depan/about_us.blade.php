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
