<!doctype html>
<html lang="en">
<head>
    <title>@yield('title')</title>
	@include('layouts.head')
    @yield('style')
</head>
<body>

<div class="wrapper">
   @include('layouts.nav')
        <div class="main-content">
            <div class="container-fluid">
                 @yield('content')
            </div>
        </div>
        <footer class="footer">
            <div class="container-fluid">

                <p class="copyright pull-right">
					&copy; <script>document.write(new Date().getFullYear())</script> <em> Angel Nails</em>
                </p>
            </div>
        </footer>
    </div>
</body>
    @include('layouts.scripts')
    @yield('js')
</html>