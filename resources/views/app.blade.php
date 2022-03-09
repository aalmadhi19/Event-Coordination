<!DOCTYPE html>
<html class="h-full bg-gray-100">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/DB.css') }}" rel="stylesheet">

    <script
        src="https://polyfill.io/v3/polyfill.min.js?features=smoothscroll,NodeList.prototype.forEach,Promise,Object.values,Object.assign"
        defer></script>

    <script src="https://polyfill.io/v3/polyfill.min.js?features=String.prototype.startsWith" defer></script>
    <script src="https://kit.fontawesome.com/930c702bfb.js" crossorigin="anonymous"></script>


    <script src="https://js.pusher.com/3.0/pusher.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBpGhzEHM4mMMR-CsgDsw-oGsppkLebo4"></script>

    <script src="{{ mix('/js/app.js') }}" defer></script>
    @inertiaHead
</head>

<body dir="{{ App::isLocale('ar') ? 'rtl' : 'ltr' }}" class=" leading-none text-gray-700 antialiased">
    @inertia
    {!! QrCode::generate('http://www.simplesoftware.io'); !!}


</body>

</html>
