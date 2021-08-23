<?php

namespace App\Http\Controllers;

use App\Serie;
use Illuminate\Http\Request;

class TemporadasController extends Controller
{
    public function index(int $id)
    {
        $serie = Serie::find($id);
        $temporadas = $serie->temporadas;
        return view('temporadas.index', compact('temporadas'));
    }
}
