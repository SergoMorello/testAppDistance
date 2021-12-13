<?php

class appService extends core {
	public function boot() {
		//
	}
	
	public function register() {
		app::include('app.inc.phpgeo-master.src.Ellipsoid');
		app::include('app.inc.phpgeo-master.src.GeometryInterface');
		app::include('app.inc.phpgeo-master.src.Distance.DistanceInterface');
		app::include('app.inc.phpgeo-master.src.Distance.Vincenty');
		app::include('app.inc.phpgeo-master.src.Coordinate');

		app::singleton('dadata',function(){
			app::include('app.classes.dadata');
			return new Dadata(
				config('TOKEN'),
				config('SECRET')
			);
		});
	}
}