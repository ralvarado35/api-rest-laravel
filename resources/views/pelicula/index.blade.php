<H1>{{ $titulo }}</H1>
<p>Index del controlador</p>

@if(isset($pagina))
    <h2>La pagina es {{ $pagina }}</h2>
@endif

<a href=" {{ route('detallepelicula') }}">Ir al detalle</a>