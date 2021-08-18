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
        $nome = $request->nomeSerie;

        $serie = new Serie();
        $serie->nome = $nome;
        $serie->save();

        $request->session()->flash('mensagem', "A série {$serie->nome} foi criada com sucesso!");
        return redirect()->route('serie.index');
    }

    public function destroy(Request $request, $id)
    {
        Serie::destroy($id);

        $request->session()->flash('mensagem', "A série foi deletada com sucesso!");
        return redirect()->route('serie.index');

    }
}
