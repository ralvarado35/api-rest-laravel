<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Titulo - @yield('titulo')</title>
</head>
<body>
    @section('header')
       <H1>CABECERA DE LA WEB (MASTER)</H1> 
    @show
    <hr>
    <div class="container">
        @yield('content')
    </div>
    <hr>
    @section('footer')
       <h1>PIE DE PAGINA DE LA WEB (MASTER)</h1> 
    @show

</body>
</html>