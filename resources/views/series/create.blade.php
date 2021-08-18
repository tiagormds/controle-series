@extends('layout')

@section('title', 'Controle de Séries')

@section('content')
@section('title_menu', 'Cadastrar série')
    <form action="{{ route('serie.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label class="lab" for="nomeSerie">Nome da série</label>
            <input class="form-control" type="text" name="nomeSerie">
        </div>

        <button class="btn btn-primary">Cadastrar</button>
    </form>
@endsection
