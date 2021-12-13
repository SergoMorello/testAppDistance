<?php
route::get("/","MainController@index")->name('home');

route::post("/submit","MainController@submit")->name('submit');

route::group(['prefix'=>'api'],function(){
	route::post('/autocomplete','DadataController@autocomplete')->name('autocomplete');

	route::post('/get','DadataController@get')->name('get');

	route::post("/submit","MainController@submitApi")->name('submitApi');
});

