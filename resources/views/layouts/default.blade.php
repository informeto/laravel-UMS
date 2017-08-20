<html>
<head>
    @yield('title')
    @include('include.head')
    @yield('css')
</head>
<body>
<div class="container">

    <header class="row">
        @include('include.header')
    </header>

    <div id="main" class="row">
            @yield('content')
    </div>

</div>
@yield('js')
</body>
</html>
