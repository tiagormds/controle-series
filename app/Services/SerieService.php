<?php

namespace App\Services;

use App\Episodio;
use App\Serie;
use App\Temporada;
use Illuminate\Support\Facades\DB;

/**
 *
 */
class SerieService
{

    /**
     * @param string $nomeSerie
     * @param int $qtdTemporadas
     * @param int $qtdEpisodio
     * @return Serie
     */
    public function criarSerie(string $nomeSerie, int $qtdTemporadas, int $qtdEpisodio): Serie
    {
        DB::beginTransaction();
        $serie = Serie::create(['nome' => $nomeSerie]);
        $this->criaTemporadas($qtdTemporadas, $serie, $qtdEpisodio);
        DB::commit();

        return $serie;
    }

    /**
     * @param int $id
     * @return string
     */
    public function removerSerie(int $id): string
    {
        $nomeSerie = '';
        DB::transaction(function () use ($id, &$nomeSerie) {
            $serie = Serie::find($id);
            $nomeSerie = $serie->nome;

            $this->removerTemporadas($serie, $id);
            $serie->delete();
            Serie::destroy($id);
        });

        return $nomeSerie;
    }

    /**
     * @param $serie
     * @param int $id
     * @throws \Exception
     */
    private function removerTemporadas(Serie $serie, int $id): void
    {
        $serie->temporadas->each(function (Temporada $temporada) {
            $this->removerEpisodios($temporada);
            $temporada->delete();
        });
    }

    /**
     * @param Temporada $temporada
     * @throws \Exception
     */
    private function removerEpisodios(Temporada $temporada): void
    {
        $temporada->episodios()->each(function (Episodio $episodio) {
            $episodio->delete();
        });
    }

    /**
     * @param string $qtdTemporadas
     * @param $serie
     * @param string $qtdEpisodio
     */
    public function criaTemporadas(string $qtdTemporadas, $serie, string $qtdEpisodio): void
    {
        for ($i = 1; $i <= $qtdTemporadas; $i++) {
            $temporada = $serie->temporadas()->create(['numero' => $i]);

            $this->criaEpisodios($qtdEpisodio, $temporada);
        }
    }

    /**
     * @param string $qtdEpisodio
     * @param $temporada
     */
    public function criaEpisodios(string $qtdEpisodio, $temporada): void
    {
        for ($j = 1; $j <= $qtdEpisodio; $j++) {
            $temporada->episodios()->create(['numero' => $j]);
        }
    }
}
