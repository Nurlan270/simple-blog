<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('icon.jpg') }}" type="image/x-icon">
    <title>
        @yield('page.title') | {{ __('Admin panel') }} - {{ config('app.name') }}
    </title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    @stack('css')
    @stack('404')
    @stack('trix')
</head>
<body>

<div class="d-flex flex-column justify-content-between min-vh-100">

    @include('includes.admin-header')

    <main class="d-flex">
        @include('includes.admin-sidebar')
        <div class="flex-grow-1 p-4" style="height: 1000px">
            @yield('content')
        </div>
    </main>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
