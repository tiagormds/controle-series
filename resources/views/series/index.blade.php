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
<table class="table table-bordered table-hover table-striped">
    <thead>
    <tr>
        <th>Nome da Série</th>
        <th colspan="3">
            <center>Ações</center>
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($series as $serie)
        <tr>
            <td>
                <span id="nome-serie-{{ $serie->id }}">{{$serie->nome}}</span>

                <div class="input-group w-50" hidden id="input-nome-serie-{{ $serie->id }}">
                    <input type="text" class="form-control" value="{{ $serie->nome }}" name="nomeSerie">
                    <div class="input-group-append">
                        <button class="btn btn-primary" onclick="editarSerie({{ $serie->id }})">
                            ok
                        </button>
                        @csrf
                    </div>
                </div>
            </td>

            <td>
                <button class="btn btn-info" onclick="toggleInput({{ $serie->id }})">Editar</button>
            </td>
            <td>
                <a class="btn btn-info" href="{{ route('temporada.index', $serie->id) }}">Acessar</a>
            </td>
            <td>
                <form method="post" action="{{ route('serie.destroy', $serie->id) }}"
                      onsubmit="return confirm('Tem certeza?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Apagar</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<script>
    function toggleInput(serieId){
        const nomeSerieElement = document.getElementById(`nome-serie-${serieId}`);
        const inputSerieElement = document.getElementById(`input-nome-serie-${serieId}`);

        if (nomeSerieElement.hasAttribute('hidden')){
            nomeSerieElement.removeAttribute('hidden');
            inputSerieElement.hidden = true;
        }else {
            inputSerieElement.removeAttribute('hidden');
            nomeSerieElement.hidden = true;
        }
    }

    function editarSerie(serieId){
        let formData = new FormData();
        const nomeSerie = document.querySelector(`#input-nome-serie-${serieId} > input`).value;
        const token = document.querySelector('input[name="_token"]').value;
        formData.append('nomeSerie', nomeSerie);
        formData.append('_token', token);

        const url = `/series/update/${serieId}`;
        fetch(url, {
            body: formData,
            method: 'POST'
        }).then(() =>{
            toggleInput(serieId);
            document.getElementById(`nome-serie-${serieId}`).textContent = nomeSerie;
        });
    }
</script>

@endsection

