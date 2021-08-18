<?php


Route::get('/', function (){
    return redirect()->route('serie.index');
});

Route::get('series', 'SeriesController@index')->name('serie.index');
Route::get('series/create', 'SeriesController@create')->name('serie.create');
Route::post('series/create', 'SeriesController@store')->name('serie.store');
Route::delete('series/destroy/{id}', 'SeriesController@destroy')->name('serie.destroy');
