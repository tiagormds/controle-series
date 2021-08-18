<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Serie;
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

    public function store(SeriesFormRequest $request)
    {
        $serie = Serie::create(['nome' => $request->nomeSerie]);
        $qtdTemporadas = $request->numeroTemporadas;
        $qtdEpisodio = $request->numeroEpisodios;

        for ($i = 1; $i <= $qtdTemporadas; $i++){
            $temporada = $serie->temporadas()->create(['numero' => $i]);

            for ($j = 1; $j <= $qtdEpisodio; $j++){
                $temporada->episodios()->create(['numero' => $j]);
            }
        }

        $request->session()->flash('mensagem', "A série {$serie->nome} e suas temporadas e episódios foram criados com sucesso!");
        return redirect()->route('serie.index');
    }

    public function destroy(Request $request, $id)
    {
        Serie::destroy($id);

        $request->session()->flash('mensagem', "A série foi deletada com sucesso!");
        return redirect()->route('serie.index');

    }
}
