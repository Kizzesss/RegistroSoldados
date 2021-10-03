@extends('layouts.app')
@section('content')

<div class="container">
<form action="{{ url('/soldado/'.$soldado->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    {{ method_field('PATCH') }}
    @include('soldado.form', ['modo'=>'Editar'])
</form>
</div>
@endsection

