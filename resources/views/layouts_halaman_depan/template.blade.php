@include('layouts_halaman_depan.header')
        @yield('content')
@include('layouts_halaman_depan.footer')
<script src="{{ asset('halaman_depan/script.js') }}"></script>
@yield('script')
