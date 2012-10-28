<?php

class Controller {
	public $output;
	public $data=array();

	function __construct($request) {
		switch (true) {
			case isset($request['actor']):
				$this->getBirthdaysByActor($request['actor']);
			break;
			case isset($request['date']):
				$this->getBirthdaysByDate($request['date']);
			break;
			case isset($request['film']):
				$this->getBirthdaysByFilm($request['film']);
			break;
			default:
				$output=false;
		}
	}

	private function getBirthdaysByActor($actor) {
		$this->output='actor';
		return;
	}
	private function getBirthdaysByDate($date) {
		$this->output='date';
		return;
	}
	private function getBirthdaysByFilm($film) {
		$this->output='film';
		return;
	}


}