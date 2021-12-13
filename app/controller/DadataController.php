<?php
class DadataController extends controller {

	public function autocomplete(request $req) {
		$query = $req->input('query');
		return app()->dadata->suggest("address", $query)->suggestions;
	}

	public function get(request $req) {
		$query = $req->input('query');
		return app()->dadata->clean("address", $query)->json();
	}
}