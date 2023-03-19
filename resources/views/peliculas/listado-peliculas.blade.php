@include('includes.header')

<!-- Imprmir por pantalla -->
<h1>{{$titulo}}</h1>
<h2><?=$listado[2]?></h2>
<p> {{ date('Y-m-d') }} </p>

<!-- Comentarios -->
{{-- ESTO ES UN COMENTRIO BLADE --}}


<!-- Mostrar si existe -->
<!-- <?= isset($director) ? $director: 'No hay director'; ?> -->


<!-- CONDICIONALES -->
@if ($titulo && count($listado) >= 2 )
    <h1>El titulo existe y es este: {{ $titulo }} y el listado es mayor a 2 </h1>

@elseif($titulo)
    <h1>El titulo existe y el listado NO ES MAYO A 5</H1>

@else
    <h1>El titulo no existe </h1>   
@endif

<!-- BUCLES -->
@for ($i = 0; $i <= 20;  $i++)
    El numero es: {{ $i }} </br>
@endfor

<hr>
<?php $i = 1 ?>
@while ($i <= 50)
    @if ($i % 2 == 0)
        NUMERO PAR: {{ $i }} <br>
    @endif
    <?php $i++; ?>
@endwhile
<hr>

@foreach ($listado as $pelicula)
    <p>{{ $pelicula }} </p>
@endforeach

@include('includes.footer')