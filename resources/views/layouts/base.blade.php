<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('icon.jpg') }}" type="image/x-icon">
    <title>
        @yield('page.title') | {{ config('app.name') }}
    </title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @stack('css')
    @stack('error')
    @stack('trix')

    {{-- Google Tag Manager --}}
    <script>
        (function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-MH4JWF9L');
    </script>
    {{-- End Google Tag Manager --}}
</head>
<body>
{{-- Google Tag Manager (noscript) --}}
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MH4JWF9L"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
{{-- End Google Tag Manager (noscript) --}}

<div class="d-flex flex-column justify-content-between min-vh-100">

    @include('includes.header')

    <main class="flex-grow-1 py-0">
        @yield('content')
    </main>

    @include('includes.footer')

</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@stack('error-script')
</body>
</html>
