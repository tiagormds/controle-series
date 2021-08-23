@extends('layout')

@section('title', 'Temporadas')
@section('title_menu', 'Número(s) de Temporada(s)')

@section('content')
    <table class="table table-bordered table-hover table-striped">
        <thead>
        <tr>
            <th>Número de Temporadas</th>
        </tr>
        </thead>
        <tbody>
        @foreach($temporadas as $temporada)
            <tr>
                <td class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('temporada.episodios', $temporada->id) }}">Temporada {{$temporada->numero}}</a>
                    <span class="badge badge-secondary">0/{{ $temporada->episodios->count() }}</span>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
