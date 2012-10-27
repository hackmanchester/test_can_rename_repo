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
		arsort($film_counts);
		if (reset($film_counts)>1) {
			$birthdays=array_keys($birthdays);
			$date=$birthdays[0];
			$birthday_actors=$birthday_actors[$date];
			return array('date'=>$date,'actors'=>$birthday_actors);
		}
		else {
			return array('film'=>'','actors'=>'');
		}
	}
}