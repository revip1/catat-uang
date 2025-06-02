<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>@yield('title', 'Login') - Pencatatan Uang</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- SB Admin 2 CSS -->
    <link href="{{ asset('sbadmin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('sbadmin/css/sb-admin-2.min.css') }}" rel="stylesheet" />
</head>

<body class="bg-gradient-primary">

    <!-- Main Content -->
    <div class="container">
        @yield('content')
    </div>

    <!-- Bootstrap core JavaScript and SB Admin 2 JS -->
    <script src="{{ asset('sbadmin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('sbadmin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('sbadmin/js/sb-admin-2.min.js') }}"></script>

</body>

</html>
