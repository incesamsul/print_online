@extends('layouts.v_template')

@section('content')
<section class="section">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-icon shadow-dark bg-main">
                    <i class="fas fa-credit-card"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Transaksi </h4>
                    </div>
                    <div class="card-body">
                        {{ count($transaksi) }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-icon shadow-dark bg-main">
                    <i class="fas fa-list"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Antrian print</h4>
                    </div>
                    <div class="card-body">
                        {{ count($antri) }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-icon shadow-dark bg-main">
                    <i class="fas fa-spinner"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Print di proses</h4>
                    </div>
                    <div class="card-body">
                        {{ count($proses) }}
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-icon shadow-dark bg-main">
                    <i class="fas fa-check"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Print selesai </h4>
                    </div>
                    <div class="card-body">
                        {{ count($selesai) }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-icon shadow-dark bg-main">
                    <i class="fas fa-users"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Jumlah pengguna</h4>
                    </div>
                    <div class="card-body">
                        {{ count($pengguna) }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-icon shadow-dark bg-main">
                    <i class="fas fa-spinner"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total pemasukan</h4>
                    </div>
                    <div class="card-body">
                        Rp. {{ number_format($total_pemasukan) }}
                    </div>
                </div>
            </div>
        </div>

    </div>




    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Anda berada di halaman dashboard</h4>
                </div>
                <div class="card-body">
                    <h5>Hi, Selamat datang</h5>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection

@section('script')
<script>
    $('#liDashboard').addClass('active');

</script>
@endsection
