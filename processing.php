<?php

class filmProcessing {
	public $data;

	function __construct($data) {
		$this->data=$this->_decodeJSON($data);
	}
	public function _decodeJSON($string) {
		// set $assoc = true to return an array
		return json_decode($string,true);
	}
	public function _removeYear($date) {
		$date=substr($date,5);
		return $date;
	}

	public function getFilmActors($film) {
		$film=$this->data['films'][$film];
		if (empty($film)) {
			throw new Exception('The film you are searching for does not exist.', 1);
		}
		return $film;
	}
	public function getFilmCommonBirthdays($film) {
		$actors=$this->getFilmActors($film);
		$birthdays=$birthday_actors=array();
		foreach ($actors as $actor) {
			$actor['birthday']=$this->_removeYear($actor['birthday']);
			$birthdays[$actor['birthday']]++;
			$birthday_actors[$actor['birthday']][]=$actor['name'];
		}
		arsort($birthdays);
		if (reset($birthdays)>1) {
			$birthdays=array_keys($birthdays);
			$date=$birthdays[0];
			$birthday_actors=$birthday_actors[$date];
			return array('date'=>$date,'actors'=>$birthday_actors,'film'=>$film);
		}
		else {
			return array('date'=>'','actors'=>'','film'=>$film);
		}
	}
}