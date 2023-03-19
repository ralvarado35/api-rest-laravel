<h1>{{ $fruta->nombre }}</h1>
<p>
    {{ $fruta->descripcion }}
</p>

<a href=" {{ action('App\Http\Controllers\FrutaController@delete', ['id' => $fruta->id ]) }}">Eliminar</a>
<a href=" {{ action('App\Http\Controllers\FrutaController@edit', ['id' => $fruta->id ]) }}">Actualizar</a>