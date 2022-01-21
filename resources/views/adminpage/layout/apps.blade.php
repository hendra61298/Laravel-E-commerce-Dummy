<html>
<head>
    <title>@yield('title')</title>
    @yield('meta')
</head>
<body class="hold-transition sidebar-mini">

<!-- Site wrapper -->
<div class="wrapper">
    @yield('header')
    @yield('content')  

    @yield('footer')
</div>

</body>
@yield('custom-script')
</html>