<?php

class processing {
	public $data;

	function __construct($data,$json=false) {
		$this->data=$json ? $this->_decodeJSON($data) : $data;
	}
	public function _decodeJSON($string) {
		// set $assoc = true to return an array
		return json_decode($string,true);
	}
	public function _removeYear($date) {
		return substr_count($date,'-')==2 ? substr($date,5) : $date;
	}

	public function getMostCommonFilmBirthdays($film_counts,$film_actors) {
		arsort($film_counts);
		if (reset($film_counts)>1) {
			$film=array_keys($film_counts);
			$film=$film[0];
			$film_actors=$film_actors[$film];
			return array('film'=>$film,'actors'=>$film_actors);
		}
		else {
			return array('film'=>'','actors'=>'');
		}
	}
}

include 'processing_films.php';
include 'processing_dates.php';
include 'processing_actors.php';
