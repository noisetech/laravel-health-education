<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title')</title>

    @include('includes.be.header')
</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">

            @include('includes.be.navbar')


            @include('includes.be.sidebar')


            @yield('content')

            @include('includes.be.footer')
        </div>
    </div>

    @include('includes.be.script')
</body>

</html>
