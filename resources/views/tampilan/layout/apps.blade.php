<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    @yield('meta')
</head>
<body >

<!-- Site wrapper -->
<div>
    @yield('header')
    @yield('content')  

    @yield('footer')
</div>

</body>
@yield('custom_script')
</html>