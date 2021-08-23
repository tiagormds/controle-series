<?php

namespace App\Http\Controllers;

use App\Temporada;
use Illuminate\Http\Request;

class EpisodiosController extends Controller
{
    public function index(int $id)
    {
        $temporada = Temporada::find($id);
        $episodios = $temporada->episodios;

        return view('episodios.index', compact('episodios'));
    }
}
