<?php

class Controller {
	public $output;
	public $data=array();

	function __construct($request) {
		switch (true) {
			case isset($request['date']):
				$this->getBirthdaysByDate($request['date']);
			break;
			case isset($request['actor']):
				$this->getBirthdaysByActor($request['actor']);
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
	}

	private function getBirthdaysByDate($date) {
		$this->output='date';
		$db=new Database();
		$this->data['actors']=$db->getBirthdaysByDate($date);
		$this->data['actors_films']=$db->getFilmsByActors($this->data['actors']);
	}

	private function getBirthdaysByFilm($film) {
		$this->output='film';
		return;
	}
}

class Database {
	private $db;
	function __construct() {
		$this->db = new Mongo();
	}
	public function getDBActorBirthdays() {
		return $this->db->actor_birthdays->actor_birthdays->actor_birthdays;
	}
	public function getActorBirthday($actor) {
		$actors = $this->getDBActorBirthdays();
	    $actor = $actors->findOne(array('name' => $actor));
	    $day = substr($actor['date'], 0, 2);
	    $month = (int) substr($actor['date'], 3, 2);

	    return "$day-$month";
	}
	public function getBirthdaysByDate($date) {
		$actors = $this->getDBActorBirthdays();
	    $actors = $actors->find(array('date' => $date));
	    $actors=iterator_to_array($actors);

	    return $actors;
	}
	public function getFilmsByActors($search_actors) {
		$actors = $this->getDBActorBirthdays();
		$actor_films=array();
		foreach ($search_actors as $actor) {
	    	$actor = $actors->findOne(array('name' => $actor));
	    	$actor_films[$actor['name']]=$actor['films'];
		}

	    return $actor_films;
	}
}