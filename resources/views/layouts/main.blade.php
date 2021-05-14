<!DOCTYPE html>
<html lang="en">
<head>
    <title>Job Finder &mdash; Colorlib Website Template</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @include('frontend.partials.header')
</head>

<body>
    @include('frontend.partials.nav')
    @yield('content')
    @include('frontend.partials.footer')
</body>
</html>
