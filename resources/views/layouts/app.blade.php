<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Citiis\'Go — Wisata Galunggung')</title>
    <link rel="stylesheet" href="{{ asset('css/citiis.css') }}">
    @stack('styles')
</head>

<body>

    @include('components.navbar')
    @include('components.auth-modal')

    <main class="page-wrap">
        @yield('content')
    </main>

    @include('components.footer')

    @stack('scripts')
</body>

</html>
