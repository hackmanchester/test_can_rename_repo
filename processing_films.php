<?php
class filmProcessing extends processing {

	public function getFilmActors($film) {
		$film=$this->data['films'][$film];
		if (empty($film)) {
			throw new Exception('The film you are searching for does not exist.', 1);
		}
		return $film;
	}
	public function getFilmCommonBirthdays($film) {
		$actors=$this->getFilmActors($film);
		$birthday=$this->getActorsCommonBirthdays($actors);
		$birthday['film']=$film;
		return $birthday;
	}
	public function getActorsCommonBirthdays($actors) {
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
			return array('date'=>$date,'actors'=>$birthday_actors);
		}
		else {
			return array('date'=>'','actors'=>'');
		}
	}
	public function getCommonBirthdays() {
		$birthdays=$birthday_counts=array();
		foreach ($this->data['films'] as $film => $actors) {
			$birthdays[$film]=$this->getActorsCommonBirthdays($actors);
			$birthday_counts[$film]=is_array($birthdays[$film]['actors']) ? count($birthdays[$film]['actors']) : null;
		}
		arsort($birthday_counts);
		if (reset($birthday_counts)>0) {
			$max_birthdays_films=array_keys($birthday_counts);
			$max_birthdays_film=$max_birthdays_films[0];
			$birthdays=$birthdays[$max_birthdays_film];
			$birthdays['film']=$max_birthdays_film;
			return $birthdays;
		}
		else {
			return array('date'=>'','actors'=>'','film'=>'');
		}
	}
}