<?php

use Location\Coordinate;
use Location\Distance\Vincenty;

class MainController extends controller {
	public function index() {
		return View('home');
	}

	private function getGeo($adr) {
		$result = app()->dadata->clean("address", $adr);

		$geo_lat = $result->{'0'}->geo_lat ?? 0;
		$geo_lon = $result->{'0'}->geo_lon ?? 0;

		return (object)[
			'geoLat'=>$geo_lat,
			'geoLon'=>$geo_lon
		];
	}

	private function getDistance($adr, $adr_lat, $adr_lon) {
		$adrIn = ($adr_lat!=0 && $adr_lon!=0) ? (object)[
			'geoLat'=>$adr_lat,
			'geoLon'=>$adr_lon
		] : $this->getGeo($adr);
		$adrTo = $this->getGeo(config('ADR'));
		
		$coordinate1 = new Coordinate($adrIn->geoLat, $adrIn->geoLon);
		$coordinate2 = new Coordinate($adrTo->geoLat, $adrTo->geoLon);

		return $coordinate1->getDistance($coordinate2, new Vincenty());
	}

	private function distanceOut($distance) {
		return round($distance*0.001);
	}

	public function submit(request $req) {
		$adr = $req->input('adr');
		$adr_lat = floatval($req->input('adr_lat'));
		$adr_lon = floatval($req->input('adr_lon'));

		$distance = $this->getDistance($adr, $adr_lat, $adr_lon);

		return View('submit',[
			'distance'=>$this->distanceOut($distance),
			'adrTo'=>config('ADR')
		]);
	}

	public function submitApi(request $req) {
		
		$adr = $req->input('adr');
		$adr_lat = floatval($req->input('adr_lat'));
		$adr_lon = floatval($req->input('adr_lon'));

		$distance = $this->getDistance($adr, $adr_lat, $adr_lon);

		return [
			'distance'=>$this->distanceOut($distance),
			'adrTo'=>config('ADR')
		];
	}
}