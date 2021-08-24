@extends('layout')

@section('title', 'Episódios')
@section('title_menu', 'Lista de Episódio(s)')

@section('content')
    <form action="{{ route('temporada.episodios.assistir', $temporadaId) }}" method="post">
        @csrf
        <table class="table table-bordered table-hover table-striped">
            <thead>
            <tr>
                <th>Número de episódio</th>
                <th>Assistiu?</th>
            </tr>
            </thead>
            <tbody>
            @foreach($episodios as $episodio)
                <tr>
                    <td>
                        <a>Episódio {{$episodio->numero}}</a>
                    </td>
                    <td>
                        <input type="checkbox" name="episodios[]" value="{{ $episodio->id }}">
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <button class="btn btn-primary mt-2 mb-2">Salvar</button>
    </form>
@endsection
