<?php
class actorProcessing extends processing {
	public $actor;
	public $date;

	function __construct($actor,$date,$data,$json=false) {
		parent::__construct($data,$json);
		$this->actor=$actor;
		$this->date=$date;
	}
	public function getActorFilms($actor) {
		return $this->data['actors'][$actor];
	}
	public function getActorBirthdays() {
		$actor_films=$this->getActorFilms($this->actor);
		$birthdays=$this->getActorsCommonFilms($this->data['actors'],$actor_films);
		$birthdays['date']=$this->date;
		return $birthdays;
	}
	public function getActorsCommonFilms($actors,$actor_films) {
		foreach ($actors as $actor => $films){
			foreach ($films as $film) {
				if (in_array($film,$actor_films)) {
					$film_counts[$film]++;
					$film_actors[$film][]=$actor;
				}
			}
		}
		return $this->getMostCommonFilmBirthdays($film_counts,$film_actors);
	}
}