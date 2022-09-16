@extends('layouts_halaman_depan.template')

@section('content')
<section class="breadcrumb-section pb-3 pt-3">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Products</a></li>
            <li class="breadcrumb-item active" aria-current="page">Kesukaan</li>
        </ol>
    </div>
</section>

<section class="other-products pb-4 pt-4">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <div class="section-title table-responsive">
                    <h2>Daftar kesukaanku</h2>
                    <table class="table table-striped">
                        <tr>
                            <th>Product</th>
                            <th>Harga</th>
                            <th>Detail</th>
                        </tr>


                        <?php $total = 0 ?>
                        @if (count($like) > 0)
                            @foreach ($like as $id=>$row)
                                <tr>
                                    <td>
                                        <img class="mr-4" src="{{ asset('data/gambar_produk/' . $row->produk->gambar_produk) }}" width="100">
                                        {{ $row->produk->nama_produk }}
                                    </td>
                                    <td class="align-middle">Rp. {{ number_format($row->produk->harga_produk) }}</td>
                                    <td class="align-middle">
                                        <a href="{{ URL::to('/detail/' . $row->produk->id_produk) }}" class="btn bg-main btn-preview text-white">lihat</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                                <tr>
                                    <td colspan="5">belum ada yang kamu sukai</td>
                                </tr>
                        @endif

                       
                    </table>
                    
                </div>
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

    $('.btn-request-transaksi').on('click', function(e) {
        let totalPembayaran = $('#total_pembayaran').val();
        if(totalPembayaran < 10000){
            alert('minimal pembayaran Rp. 10,000');
            e.preventDefault();
        }
    })

    $('#liDashboard').addClass('active');

</script>
@endsection
