@extends('layouts.app')
@section('content')

<div class="container table-responsive">

@if (Session::has('mensaje'))
    <div class="alert alert-info alert-dismissible" role="alert">
        {{ Session::get('mensaje') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
        

<a href="{{url('/soldado/create')}}" class="btn btn-outline-success">Registrar Nuevo soldado</a>
<br/>
<br/>

<table class="table table-light table-hover">

    <thead class="thead-dark">
        <tr>
            <th>#</th>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Correo</th>
            <th>Escuadron</th>
            <th>Acciones</th>

        </tr>
    </thead>

    <tbody>
        @foreach ($soldados as $soldado)
        <tr>
            <td>{{ $soldado->id }}</td>

            <td>
                <img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$soldado->foto }}" width="100" height="100" alt="">
            </td>

            <td>{{ $soldado->nombre }}</td>
            <td>{{ $soldado->apellido }}</td>
            <td>{{ $soldado->correo }}</td>
            <td>{{ $soldado->escuadron }}</td>
            <td>
                <a href="{{url('/soldado/'.$soldado->id.'/edit')}}" class="btn btn-outline-info">
                Editar
                </a>
 
                <form action="{{url('/soldado/'.$soldado->id)}}" class="d-inline" method="post">
                @csrf
                {{ method_field('DELETE') }}
                <input class="btn btn-outline-danger" type="submit" onclick="return confirm('Quieres borrar el registro?')" 
                value="Borrar">
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>

</table> 
{!! $soldados->links() !!}
</div>
@endsection