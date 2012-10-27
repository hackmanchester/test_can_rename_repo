<?php

class filmProcessing {
	public $data;

	function __construct($data) {
		$this->data=$this->decodeJSON($data);
	}
	public function decodeJSON($string) {
		// set $assoc = true to return an array
		return json_decode($string,true);
	}
	public function getFilmActors($film) {
		$film=$this->data['films'][$film];
		if (empty($film)) {
			throw new Exception('The film you are searching for does not exist.', 1);
		}
		return $film;
	}
}