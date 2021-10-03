<h1>{{ $modo }} Soldado</h1>

@if (count($errors)>0)
    <div class="alert alert-danger" role="alert">
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif

<div class="form-group">
    <label for="nombre">Nombre</label>
    <input type="text" class="form-control" name="nombre" 
    value="{{ isset($soldado->nombre)?$soldado->nombre:old('nombre') }}" id="nombre">
</div>

<div class="form-group">
    <label for="apellido">Apellido</label>
    <input type="text" class="form-control" name="apellido" 
    value="{{ isset($soldado->apellido)?$soldado->apellido:old('apellido') }}" id="apellido">
</div>

<div class="form-group">
    <label for="correo">Correo</label>
    <input type="email" class="form-control" name="correo" 
    value="{{ isset($soldado->correo)?$soldado->correo:old('correo') }}" id="correo">
</div>

<div class="form-group">
    <label for="escuadron">Escuadron</label>
    <input type="number" class="form-control" name="escuadron" 
    value="{{ isset($soldado->escuadron)?$soldado->escuadron:old('escuadron') }}" id="escuadron">
</div>

<div class="form-group">
    <label for="foto"></label>
    @if(isset($soldado->foto))
    <img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$soldado->foto }}" width="100" height="100" alt="">
    @endif
    <input type="file" class="form-control" name="foto" value="" id="foto">
</div>

<input class="btn btn-outline-success" type="submit" value="{{ $modo }} soldado">

<a class="btn btn-outline-danger" href="{{url('/soldado')}}">Regresar</a>
<br>
