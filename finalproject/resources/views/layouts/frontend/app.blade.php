<!DOCTYPE html>
<html lang="zxx">
<meta name="csrf-token" content="{{ csrf_token() }}">
<head>
    @include('layouts.frontend.data.styles')
</head>

<body>

    @include('layouts.frontend.data.navbar')
    @yield('content')
    @include('layouts.frontend.data.footer')

    <a href="https://wa.me/6282232769157" target="_blank"><img src="{{ asset('ashion') }}/img/whatsapp.png" id="fixedbutton" height="10%"></a>

    <!-- Search Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form" method="get" action="{{ route('product.search') }}">
                <input type="text" id="search-input" name="q" placeholder="Cari di sini.....">
            </form>
        </div>
    </div>
    <!-- Search End -->
    @include('layouts.frontend.data.scripts')
</body>

</html>
