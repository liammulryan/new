<?php

class HomeController extends BaseController {

	protected $layout = 'layouts.master';

	public function index() {
		$pilots = Cache::get('vatsim.pilots');
		$atc = Cache::get('vatsim.atc');
		$users = Cache::get('vatsim.users');
		$year = Cache::get('vatsim.year');
		$month = Cache::get('vatsim.month');
		$day = Cache::get('vatsim.day');

		$this->autoRender(compact('pilots','atc','users','year','month','day'));
	}

}