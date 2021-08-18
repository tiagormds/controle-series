@extends('layout')

@section('title', 'Controle de Séries')

@section('content')
    @if(!empty($mensagem))
        <div class="alert alert-success">
            {{ $mensagem }}
        </div>
    @endif
@section('title_menu', 'Lista de séries')
<a class="btn btn-dark mb-2" href="{{ route('serie.create') }}">Adicionar</a>

<ul class="list-group">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>Nome da Série</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
            @foreach($series as $serie)
                <tr>
                    <td>{{$serie->nome}}</td>
                    <td>
                        <form method="post" action="{{ route('serie.destroy', $serie->id) }}" onsubmit="return confirm('Tem certeza?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Apagar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
</ul>
@endsection

