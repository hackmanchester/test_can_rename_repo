<?php
class dateProcessing extends processing {

	public function getDateActors($date) {
		$date=$this->data['dates'][$date];
		if (empty($date)) {
			throw new Exception('The date you are searching for has no birthdays listed.', 1);
		}
		return $date;
	}
	public function getDateCommonBirthdays($date) {
		$actors=$this->getDateActors($date);
		$birthdays=$this->getActorsCommonFilms($actors);
		$birthdays['date']=$date;
		return $birthdays;
	}
	public function getActorsCommonFilms($actors) {
		foreach ($actors as $actor => $films){
			foreach ($films as $film) {
				$film_counts[$film]++;
				$film_actors[$film][]=$actor;
			}
		}
		return $this->getMostCommonFilmBirthdays($film_counts,$film_actors);
	}
	public function getCommonBirthdays() {
		$birthdays=$birthday_counts=array();
		foreach ($this->data['dates'] as $date => $actors) {
			$birthdays[$date]=$this->getActorsCommonFilms($actors);
			$birthday_counts[$date]=is_array($birthdays[$date]['actors']) ? count($birthdays[$date]['actors']) : null;
		}
		arsort($birthday_counts);
		if (reset($birthday_counts)>0) {
			$max_birthdays_dates=array_keys($birthday_counts);
			$max_birthdays_date=$max_birthdays_dates[0];
			$birthdays=$birthdays[$max_birthdays_date];
			$birthdays['date']=$max_birthdays_date;
			return $birthdays;
		}
		else {
			return array('date'=>'','actors'=>'','film'=>'');
		}
	}
}