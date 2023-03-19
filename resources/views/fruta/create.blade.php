@if(isset($fruta) && is_object($fruta))
    <h1>Editar fruta</h1>
    <form action=" {{ action('App\Http\Controllers\FrutaController@update') }} " method="post">
    {{ csrf_field() }} 
    <input type="hidden" name=id value = " {{ $fruta->id }}" >    
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" value= "{{ $fruta->nombre }}"  /> <br>    
    <label for="descripcion">Descripcion</label>
    <input type="text" name="descripcion" value= "{{ $fruta->descripcion }} " /><br>    
    <label for="precio">Precio</label>
    <input type="text" name="precio" value= "{{ $fruta->precio }}" /><br>
    <input type="submit" value="Guardar" />
</form>
@else
    <h1>Crear una fruta</h1>
    <form action=" {{ action('App\Http\Controllers\FrutaController@save') }} " method="post">
    {{ csrf_field() }}    
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre"   /> <br>    
    <label for="descripcion">Descripcion</label>
    <input type="text" name="descripcion"  " /><br>    
    <label for="precio">Precio</label>
    <input type="text" name="precio"  /><br>
    <input type="submit" value="Guardar" />
</form>
@endif


