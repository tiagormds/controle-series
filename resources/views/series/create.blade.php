@extends('layout')

@section('title', 'Controle de Séries')

@section('content')
@section('title_menu', 'Cadastrar série')
    <form action="{{ route('serie.store') }}" method="post">
        @csrf
        <div class="row">
            <div class="col col-6">
                <label class="lab" for="nomeSerie">Nome da série</label>
                <input class="form-control" type="text" name="nomeSerie">
            </div>

            <div class="col col-3">
                <label class="lab" for="numeroTemporadas">Nº de Temporadas</label>
                <input class="form-control" type="number" name="numeroTemporadas">
            </div>

            <div class="col col-3">
                <label class="lab" for="numeroEpisodios">Nº de episódios da Temporada</label>
                <input class="form-control" type="number" name="numeroEpisodios">
            </div>
        </div>

        <button class="btn btn-primary mt-2">Cadastrar</button>
    </form>
@endsection
