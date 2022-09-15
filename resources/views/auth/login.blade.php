@extends('layouts_halaman_depan.template')

@section('content')
<section class="slider-section pt-4 pb-4">
    <div class="container">
        <div class="slider-inner">
            <section class="login-block">
                <div class="container-fluid login-wrapper ">
                    <div class="row login-row">
                        <div class="col-md-4 login-sec ">
                            <h2 class="text-center mt-5">Login</h2>
                            @if (session('fail'))
                            <p class="text-danger">{{ session('fail') }}</p>
                            @endif
                            <form action="{{ URL::to('/postlogin') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <i class="fa fa-user" style="font-size: 12px"></i>
                                    <label for="email" class="text-uppercase">Email</label>
                                    <input name="email" type="text" class="form-control"
                                        placeholder="Masukkan email anda">

                                </div>
                                <div class="form-group">
                                    <i class="fa fa-key" style="font-size: 12px"></i>
                                    <label for="password" class="text-uppercase">Password</label>
                                    <input name="password" type="password" class="form-control"
                                        placeholder="Masukkan password anda">
                                </div>
                                <a style="visibility: hidden" href="#" class="forgot"><u> Forgot Your Password?</u></a>
                                <button type="submit" class="btn text-white form-control bg-main">Login</button>
                            </form>
                            <div class="copy-text text-center my-4">Belum punya akun? <a
                                    href="{{ URL::to('/registrasi') }}">Registrasi</a>.</div>
                        </div>
                        <div class="col-md-8 banner-sec d-flex justify-content-center">
                            <img class="d-block img-fluid" src="{{ asset('img/jpg/slider/1.svg') }}" alt="First slide"
                                style="max-width:70%">
                        </div>
                    </div>
            </section>
        </div>
    </div>
</section>


@endsection

@section('script')
<script>
    $('#liDashboard').addClass('active');

</script>
@endsection