<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFlightsTable extends Migration {

	public function up()
	{
		Schema::create('flights', function(Blueprint $table) {
			$table->increments('id');
			$table->date('startdate');
			$table->string('callsign', 10);
			$table->integer('airline_id')->unsigned()->nullable();
			$table->mediumInteger('vatsim_id')->index();
			$table->string('departure_id',6);
			$table->string('arrival_id',6);
			$table->string('departure_country_id',2);
			$table->string('arrival_country_id',2);
			$table->text('route');
			$table->text('remarks');
			$table->string('altitude', 15);
			$table->smallInteger('speed');
			$table->tinyInteger('state')->index();
			$table->string('aircraft_code', 20);
			$table->datetime('departure_time');
			$table->datetime('arrival_time');
			$table->string('aircraft_id')->nullable()->default(null);
			$table->decimal('last_lat', 10,6);
			$table->decimal('last_lon', 10,6);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('flights');
	}
}