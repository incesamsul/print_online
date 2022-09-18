@extends('layouts_halaman_depan.template')

@section('content')
<section class="slider-section pt-4 pb-4">
    <div class="container">
        <div class="slider-inner">
            <div class="row">
                <div class="col-md-3">
                    <nav class="nav-category">
                        <h2>Categories</h2>
                        <ul class="menu-category">
                            @foreach ($kategori as $row)
                                <li><a href="#">{{ $row->nama_category }}</a></li>
                            @endforeach
                        </ul>
                    </nav>
                </div>
                <div class="col-md-9">
                    <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner shadow-sm rounded">
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="{{ asset('img/jpg/slider/1.svg') }}" alt="First slide" width="100" height="100">
                                <div class="carousel-caption d-none d-md-block">
                                    {{-- <h5>Keranjang</h5> --}}
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="{{ asset('img/jpg/slider/1.svg') }}" alt="Second slide" width="100" height="100">
                                <div class="carousel-caption d-none d-md-block">
                                    {{-- <h5>Freedom, Sea Collection</h5> --}}
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="{{ asset('img/jpg/slider/1.svg') }}" alt="Third slide" width="100" height="100">
                                <div class="carousel-caption d-none d-md-block"></div>
                                {{-- <h5>Living the Dream, Lost Island</h5> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Slider -->
            </div>
        </div>
    </div>
    </div>
</section>

<!-- Services -->
<section class="pt-5 pb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="media">
                    <div class="iconbox iconmedium rounded-circle text-info mr-4">
                        <i class="fa fa-truck"></i>
                    </div>
                    <div class="media-body">
                        <h5>Cod</h5>
                        <p class="text-muted">
                            bayar di tempat alias bayar saat bertemu langsung.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="media">
                    <div class="iconbox iconmedium rounded-circle text-purple mr-4">
                        <i class="fa fa-credit-card-alt"></i>
                    </div>
                    <div class="media-body">
                        <h5>Pembayaran online</h5>
                        <p class="text-muted">
                            pembayaran online dengan berbagai macam chanel pembayaran
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="media">
                    <div class="iconbox iconmedium rounded-circle text-warning mr-4">
                        <i class="fa fa-refresh"></i>
                    </div>
                    <div class="media-body">
                        <h5>Pengembalian</h5>
                        <p class="text-muted">
                            kemudahan pengembalian saat terjadi kesalahan
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Services -->
<section class="products-grids trending pb-4">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Daftar Layangan </h2>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            @foreach ($produk as $row)
            <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                <div class="single-product">
                    <div class="product-img">
                        <a href="{{ URL::to('/detail/' . $row->id_produk) }}">
                            <img src="{{ asset('/data/gambar_produk/'. $row->gambar_produk) }}" class="img-fluid">
                        </a>
                    </div>
                    <div class="product-content">
                        <h3><a href="product-detail.html">{{ $row->nama_produk }}</a></h3>
                        <div class="product-price">
                            <p class="text-sm m-0">Rp. {{ number_format($row->harga_warna) }} (warna)</p>
                            <p class="text-sm m-0">Rp. {{ number_format($row->harga_bw)}} (bw)</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
{{-- <section class="mobile-apps pt-5 pb-3 border-top">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3>Download apps</h3>
                <p>Get an amazing app to make Your life easy</p>
            </div>
            <div class="col-md-6 text-md-right">
                <a href="#"><img src="{{ asset('theme-indomarket-master/assets/img/appstore.png') }}" height="40"></a>
                <a href="#"><img src="{{ asset('theme-indomarket-master/assets/img/appstore.png') }}" height="40"></a>
            </div>
        </div> <!-- row.// -->
    </div><!-- container // --> --}}
</section>
@endsection

@section('script')
<script>
    $('#liDashboard').addClass('active');

</script>
@endsection
