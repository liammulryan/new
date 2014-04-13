<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('', ['as' => 'home', 'uses' => 'HomeController@index']);

// Flights
Route::get('flight', ['as' => 'flight.index', 'uses' => 'FlightController@index']);
Route::get('flight/{flight}', ['as' => 'flight.show', 'uses' => 'FlightController@show'])->where('flight','[0-9]+');

// Pilots
Route::get('pilot', ['as' => 'pilot.index', 'uses' => 'PilotController@index']);
Route::get('pilot/{pilot}', ['as' => 'pilot.show', 'uses' => 'PilotController@show'])->where('pilot','[0-9]+');
Route::get('pilot/{pilot}/flights', ['as' => 'pilot.flights', 'uses' => 'PilotController@flights'])->where('pilot','[0-9]+');

// ATC
Route::get('atc', ['as' => 'atc.index', 'uses' => 'ATCController@index']);
Route::get('atc/{atc}', ['as' => 'atc.show', 'uses' => 'ATCController@show'])->where('atc','[0-9]+');

// Controllers
Route::get('controller', ['as' => 'controller.index', 'uses' => 'ControllerController@index']);
Route::get('controller/{pilot}', ['as' => 'controller.show', 'uses' => 'ControllerController@show'])->where('pilot','[0-9]+');
// Route::get('controller/{pilot}/duties', ['as' => 'controller.duties', 'uses' => 'ControllerController@duties'])->where('pilot','[0-9]+');

Route::get('search', ['as' => 'search', 'uses' => 'SearchController@index']);

Route::bind('flight',function($value, $route) {
	$flight = Flight::with('aircraft','departure','arrival','pilot','departureCountry','arrivalCountry','airline','positions')->find($value);

	if(is_null($flight) || $value === 0) {
		return App::abort(404);
	} else {
		return $flight;
	}
});

Route::bind('atc',function($value, $route) {
	$atc = ATC::with('pilot')->find($value);

	if(is_null($atc) || $value === 0) {
		return App::abort(404);
	} else {
		return $atc;
	}
});

Route::bind('pilot',function($value, $route) {
	$pilot = Pilot::whereVatsimId($value)->first();

	if(is_null($pilot) || $value === 0) {
		return App::abort(404);
	} else {
		return $pilot;
	}
});

// Redirect old urls
Route::get('flight.cfm', function() {
	if(!Input::has('id')) return Redirect::route('flight.index');
	return Redirect::route('flight.show', array('flight' => Input::get('id')), 301);
});

Route::get('pilot.cfm', function() {
	if(!Input::has('id')) return Redirect::route('pilot.index');
	return Redirect::route('pilot.show', array('pilot' => Input::get('id')), 301);
});
