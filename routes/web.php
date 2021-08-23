<?php


Route::get('/', function (){
    return redirect()->route('serie.index');
});

Route::get('series', 'SeriesController@index')->name('serie.index');
Route::get('series/create', 'SeriesController@create')->name('serie.create');
Route::post('series/create', 'SeriesController@store')->name('serie.store');
Route::post('series/update/{id}', 'SeriesController@update')->name('serie.update');
Route::delete('series/destroy/{id}', 'SeriesController@destroy')->name('serie.destroy');

Route::get('temporadas/{id}', 'TemporadasController@index')->name('temporada.index');
Route::get('temporadas/episodios/{id}', 'EpisodiosController@index')->name('temporada.episodios');
