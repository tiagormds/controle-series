<?php

namespace App\Http\Controllers;

use App\Episodio;
use App\Http\Requests\SeriesFormRequest;
use App\Serie;
use App\Services\SerieService;
use App\Temporada;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        $series = Serie::query()->orderBy('nome')->get();

        $mensagem = $request->session()->get('mensagem');
        return view('series.index', compact('series', 'mensagem'));
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request, SerieService $criadorDeSerie)
    {
        $seie = $criadorDeSerie->criarSerie($request->nomeSerie, $request->numeroTemporadas, $request->numeroEpisodios);

        $request->session()->flash('mensagem', "A série {$request->nomeSerie} e suas temporadas e episódios foram criados com sucesso!");
        return redirect()->route('serie.index');
    }

    public function update(Request $request, int $id)
    {
        $novoNomeSerie = $request->nomeSerie;
        $serie = Serie::find($id);
        $serie->nome = $novoNomeSerie;
        $serie->save();
    }

    public function destroy(Request $request, SerieService $removedorDeSerie, int $id)
    {
        $nomeSerie = $removedorDeSerie->removerSerie($id);

        $request->session()->flash('mensagem', "A série: {$nomeSerie}, foi deletada com sucesso!");
        return redirect()->route('serie.index');
    }
}
