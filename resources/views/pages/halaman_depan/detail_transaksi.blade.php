@extends('layouts_halaman_depan.template')

@section('content')
<section class="breadcrumb-section pb-3 pt-3">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Beranda</a></li>
            <li class="breadcrumb-item"><a href="#">Produk</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail transaksi</li>
        </ol>
    </div>
</section>

<section class="other-products pb-4 pt-4">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <div class="section-title table-responsive">
                    <h2>Detail Transaksi</h2>
                    <p>Ref No. #{{ $detail_transaksi->reference }}</p>
                    <h1>Total : Rp. {{ number_format($detail_transaksi->amount) }}</h1>
                    <p>{{ $detail_transaksi->customer_name }}</p>
                    <p>{{ $detail_transaksi->customer_email }}</p>
                    @if ($detail_transaksi->payment_name == 'QRIS')
                    <p><img src="{{ $detail_transaksi->qr_url }}" alt=""></p>
                    @endif
                </div>
            </div>
            <div class="col-sm-4">
                <h2>Instruksi pembayaran</h2>
                <div class="accordion" id="accordionExample">
                    @foreach ($detail_transaksi->instructions as $instruksi)
                    <div class="card">
                        <div class="card-header" id="headingOne">
                          <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#what{{$loop->iteration}}" aria-expanded="true" aria-controls="what{{$loop->iteration}}">
                              {{ $instruksi->title }}
                            </button>
                          </h2>
                        </div>
                        <div id="what{{$loop->iteration}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                          <div class="card-body">
                            <ul>
                                @foreach ($instruksi->steps as $step)
                                    <li>{!! $step !!}</li>
                                @endforeach
                            </ul>
                          </div>
                        </div>
                      </div>
                    @endforeach
            </div>
        </div>
        <div class="row mt-4">

        </div>
    </div>
</section>



  <!-- Modal -->
  <div class="modal fade" id="previewFile" tabindex="-1" aria-labelledby="previewFileLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="previewFileLabel">Preview file</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <iframe id="iframe-preview" style="width: 100%;height:100vh;" src="" frameborder="0"></iframe>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
<script>

    $('.btn-preview').on('click', function() {
        let path = $(this).data('path');
        $('#iframe-preview').attr('src',path);
    })
    $('#liDashboard').addClass('active');

</script>
@endsection
