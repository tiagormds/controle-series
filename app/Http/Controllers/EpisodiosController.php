<?php

namespace App\Http\Controllers;

use App\Episodio;
use App\Temporada;
use Illuminate\Http\Request;

class EpisodiosController extends Controller
{
    public function index(int $id)
    {
        $temporada = Temporada::find($id);
        $episodios = $temporada->episodios;
        $temporadaId = $id;

        return view('episodios.index', compact('episodios', 'temporadaId'));
    }

    public function assistir(Request $request, Temporada $temporada)
    {
        $episodiosAssitidos = $request->episodios;
        $temporada->episodios->each(function (Episodio $episodio) use ($episodiosAssitidos){
            $episodio->assistido = in_array($episodio->id, $episodiosAssitidos);
        });
        var_dump($temporada);
        exit();
        $temporada->push();
    }
}
