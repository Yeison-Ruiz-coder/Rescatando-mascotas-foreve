<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        @yield('title')
    </title>
</head>
<body>

   
    <h1>Desde esta plantilla realizo cambios a las otras vistas</h1>
    @include('layouts1._partials.menu')
    @yield('content')
</body>
</html>