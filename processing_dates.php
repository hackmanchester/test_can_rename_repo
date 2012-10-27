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