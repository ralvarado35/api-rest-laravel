<h1>Formulario en Laravel</h1>
<form action="{{ action('App\Http\Controllers\PeliculaController@recibir') }}" method="post">
   {{ csrf_field() }}
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre"/>
    <br>
    <br>
    <label for="email">Correo</label>
    <input type="email" name="email"/>
    <br>
    <br>

    <input type="submit" value="Enviar" />

</form>