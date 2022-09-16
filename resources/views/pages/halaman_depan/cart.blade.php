@extends('layouts_halaman_depan.template')

@section('content')
<section class="breadcrumb-section pb-3 pt-3">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Products</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cart</li>
        </ol>
    </div>
</section>

<section class="other-products pb-4 pt-4">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <div class="section-title table-responsive">
                    <h2>Keranjangku</h2>
                    <table class="table table-striped">
                        <tr>
                            <th>Product</th>
                            <th>Harga</th>
                            <th>File</th>
                            <th>Lbr</th>
                            <th>Subtotal</th>
                            <th>#</th>
                        </tr>


                        <?php $total = 0 ?>
                        @if (count($cart) > 0)
                            @foreach ($cart as $id=>$row)
                                <tr>
                                    <td>
                                        <img class="mr-4" src="{{ asset('data/gambar_produk/' . $row->produk->gambar_produk) }}" width="100">
                                        {{ $row->produk->nama_produk }}
                                    </td>
                                    <td class="align-middle">Rp. {{ number_format($row->produk->harga_produk) }}</td>
                                    <td class="align-middle">
                                        <a data-path="{{ asset('data/file_print/' . $row->file)}}"class="btn bg-main btn-preview text-white" data-toggle="modal" data-target="#previewFile">lihat</a>
                                    </td>
                                    <td class="align-middle">{{ count_pdf_pages($row->file) }}</td>
                                    <td class="align-middle">Rp. {{ count($cart) > 0 ? number_format(count_pdf_pages($row->file) * $row->produk->harga_produk) : '' }}</td>
                                    <td class="align-middle"><a href="{{ URL::to('remove-from-cart/' . $row->id_cart) }}"><i class="fa fa-trash text-danger"></i></a></td>
                                </tr>
                            @endforeach
                        @else
                                <tr>
                                    <td colspan="5">Tidak ada barang di keranjang</td>
                                </tr>
                        @endif

                        <?php $pesan = "" ?>
                        <?php $pesan .= "halo saya ingin memesan produk berikut: %3A%0D%0A%0D%0A%2A"; ?>
                        @if (session('cart'))
                            @foreach (session('cart') as $id=>$row)
                            <?php
                                $pesan .= "nama produk: ". $row['nama_produk'] . '%2A%0D%0A';
                                $pesan .= "harga produk: " . number_format($row['harga_produk']) . '%2A%0D%0A';
                                $pesan .= "qty: " . $row['qty'] . '%2A%0D%0A%2A%0D%0A';
                                ?>
                            @endforeach
                            <?php
                            $pesan .= "total : " . number_format($total);
                             ?>
                        @endif
                    </table>
                    <a href="{{ URL::to('/') }}" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Lanjutkan belanja </a>
                    <a href="{{ URL::to('/') }}" class="btn bg-main text-white"><i class="fa fa-pen"></i> Update keranjang </a>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="section-title">
                    <h2>Cart total</h2>
                    <table class="table">
                        <tr>
                            <th>Sub total</th>
                            <th>Rp. {{ count($cart) > 0 ? number_format(count_pdf_pages($row->file) * $row->produk->harga_produk) : '' }}</th>
                        </tr>
                        <tr>
                            <th>Sub total</th>
                            <th>Rp. {{ count($cart) > 0 ? number_format(count_pdf_pages($row->file) * $row->produk->harga_produk) : '' }}</th>
                        </tr>
                    </table>
                    @if (count($cart) > 0)
                    <h5>Pilih metode pembayaran</h5>
                    <div class="row">
                    @foreach ($channels as $channel)
                            <div class="col-sm-6 my-2">
                                <div class="card border-0 hover-card">
                                    <form action="{{ URL::to('/transaksi') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id_cart" value="{{ count($cart) > 0 ? $row->id_cart : '' }}">
                                        <input id="total_pembayaran" type="hidden" name="total_pembayaran" value="{{ count($cart) > 0 ? count_pdf_pages($row->file) * $row->produk->harga_produk : '' }}">
                                        <input type="hidden" name="method" value="{{ $channel->code }}">
                                        <input type="hidden" name="method" value="{{ $channel->code }}">
                                        <button type="submit" class="card-body border-0 bg-transparent btn-request-transaksi">
                                            <img src="{{ $channel->icon_url }}" alt="" width="100">
                                            <p class="text-small mt-3">{{ $channel->name }}</p>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            @endforeach
                    </div>
                    @endif
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
