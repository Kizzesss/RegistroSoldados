@extends('layouts.app')
@section('content')

<div class="container">
<form action="{{ url('/soldado') }}" method="post" enctype="multipart/form-data">
    @csrf
    @include('soldado.form', ['modo'=>'Crear'])
</form>
</div>
@endsection