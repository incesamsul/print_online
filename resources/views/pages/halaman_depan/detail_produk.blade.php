@extends('layouts_halaman_depan.template')

@section('content')
<section class="breadcrumb-section pb-3 pt-3">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Products</a></li>
            <li class="breadcrumb-item active" aria-current="page">Product Detail</li>
        </ol>
    </div>
</section>
<section class="product-page pb-4 pt-4">
    <div class="container">
        <div class="row product-detail-inner">
            <div class="col-lg-6 col-md-6 col-12">
                <div id="product-images" class="carousel slide" data-ride="carousel">
                    <!-- slides -->
                    <div class="carousel-inner">
                        <div class="carousel-item active"> <img src="{{ asset('data/gambar_produk/'. $detail_produk->gambar_produk) }}" alt="Product 1"> </div>
                        <div class="carousel-item"> <img src="{{ asset('data/gambar_produk/'. $detail_produk->gambar_produk) }}" alt="Product 2"> </div>
                        <div class="carousel-item"> <img src="{{ asset('data/gambar_produk/'. $detail_produk->gambar_produk) }}" alt="Product 3"> </div>
                        <div class="carousel-item"> <img src="{{ asset('data/gambar_produk/'. $detail_produk->gambar_produk) }}" alt="Product 4"> </div>
                    </div> <!-- Left right -->
                    <a class="carousel-control-prev" href="#product-images" data-slide="prev"> <span class="carousel-control-prev-icon"></span> </a> <a class="carousel-control-next" href="#product-images" data-slide="next"> <span class="carousel-control-next-icon"></span> </a><!-- Thumbnails -->
                    <ol class="carousel-indicators list-inline">
                        <li class="list-inline-item active"> <a id="carousel-selector-0" class="selected" data-slide-to="0" data-target="#product-images"> <img src="{{ asset('data/gambar_produk/'. $detail_produk->gambar_produk) }}" class="img-fluid"> </a> </li>
                        <li class="list-inline-item"> <a id="carousel-selector-1" data-slide-to="1" data-target="#product-images"> <img src="{{ asset('data/gambar_produk/'. $detail_produk->gambar_produk) }}" class="img-fluid"> </a> </li>
                        <li class="list-inline-item"> <a id="carousel-selector-2" data-slide-to="2" data-target="#product-images"> <img src="{{ asset('data/gambar_produk/'. $detail_produk->gambar_produk) }}" class="img-fluid"> </a> </li>
                        <li class="list-inline-item"> <a id="carousel-selector-3" data-slide-to="3" data-target="#product-images"> <img src="{{ asset('data/gambar_produk/'. $detail_produk->gambar_produk) }}" class="img-fluid"> </a> </li>
                    </ol>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <div class="product-detail">
                    <h2 class="product-name">{{ $detail_produk->nama_produk }}</h2>
                    <div class="product-price">
                        {{-- <span class="price">IDR 299.000</span><span class="price-muted">IDR 499.000</span> --}}
                        <span class="price">Rp. {{ number_format($detail_produk->harga_warna) }} (warna)</span><span class="price-muted">IDR {{ number_format($detail_produk->harga_produk) }}</span>
                        <span class="price">Rp. {{ number_format($detail_produk->harga_bw) }}(bw)</span><span class="price-muted">IDR {{ number_format($detail_produk->harga_produk) }}</span>
                    </div>
                    <div class="product-short-desc">
                        <p>{{ $detail_produk->deskripsi }}
                        </p>
                    </div>
                    <div class="product-select">
                        <form method="POST" action="{{ URL::to('/add-to-cart/'.$detail_produk->id_produk) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-3">
                                    <input accept="application/pdf" required type="file" class="form-control" name="file"/>
                                </div>
                                <div class="col-md-5">
                                    <button type="submit" class="btn bg-main text-white btn-block">Add to Cart</button>
                                </div>
                                <div class="col-md-4">
                                    @if (auth()->user())
                                    @if (isLike(auth()->user()->id, $detail_produk->id_produk))
                                    <a href="{{ URL::to('/unlike/' . $detail_produk->id_produk) }}" class="btn btn-secondary"><i class="fa fa-heart text-danger"></i></a>
                                    @else
                                    <a href="{{ URL::to('/like/' . $detail_produk->id_produk) }}" class="btn btn-secondary"><i class="fa fa-heart-o"></i></a>
                                    @endif
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="product-categories">
                        <ul>
                            <li class="categories-title">Categories :</li>
                            <li><a href="#">{{ $detail_produk->kategori->nama_category }}</a></li>
                            {{-- <li><a href="#">fashion</a></li>
                            <li><a href="#">electronics</a></li>
                            <li><a href="#">toys</a></li>
                            <li><a href="#">food</a></li>
                            <li><a href="#">jewellery</a></li> --}}
                        </ul>
                    </div>
                    <div class="product-tags">
                        <ul>
                            <li class="categories-title">Tags :</li>
                            <li><a href="#">{{ $detail_produk->kategori->nama_category }}</a></li>
                            {{-- <li><a href="#">fashion</a></li>
                            <li><a href="#">electronics</a></li>
                            <li><a href="#">toys</a></li>
                            <li><a href="#">food</a></li>
                            <li><a href="#">jewellery</a></li> --}}
                        </ul>
                    </div>
                    <div class="product-share">
                        <ul>
                            <li class="categories-title">Share :</li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="product-details">
                    <div class="nav-wrapper">
                        <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">Reviews</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                                    <p>{{ $detail_produk->deskripsi }}</p>
                                </div>
                                <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                                    <div class="review-form">
                                        <h3>Write a review</h3>
                                        <form>
                                            <div class="form-group">
                                                <label>Your Name</label>
                                                <input type="text" class="form-control"/>
                                            </div>
                                            <div class="form-group">
                                                <label>Your Review</label>
                                                <textarea cols="4" class="form-control"></textarea>
                                            </div>
                                            <button type="submit" class="btn bg-main text-white">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="other-products pb-4 pt-4">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Related Products</h2>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            @foreach ($produk as $row)
            <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                <div class="single-product">
                    <div class="product-img">
                        <a href="{{ URL::to('/detail/' . $row->id_produk) }}">
                            <img src="{{ asset('/data/gambar_produk/'. $row->gambar_produk) }}" class="img-fluid" >
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
@endsection

@section('script')
<script>
    $('#liDashboard').addClass('active');

</script>
@endsection
