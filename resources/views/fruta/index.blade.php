<h1>Listado de Frutas</h1>
<h3> <a href="{{ action('App\Http\Controllers\FrutaController@create') }} ">Crear Fruta</a></h3>

@if(session('status'))
<p style="background: green; color: white">
    {{ session('status') }}
</p>

@endif


<ul>
    @foreach($frutas as $fruta)
        <li>
            <a href="{{ action('App\Http\Controllers\FrutaController@detail', ['id' => $fruta->id]) }}">
           {{ $fruta->nombre }}
            </a>
        </li>

    @endforeach

</ul>
            