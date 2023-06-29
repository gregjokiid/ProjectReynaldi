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

    @include('layouts.frontend.data.scripts')
</body>

</html>
