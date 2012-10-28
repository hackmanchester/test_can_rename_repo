<?php
include 'base.php';

class ByFilm extends ProcessingTests {
	protected $type='films';

	protected function newProcess() {
		$json=$this->getJSON($this->type);
		return new filmProcessing($json,true);
	}

	// now we move on to actual callable functions
	/**
     * 
     * @expectedException Exception
     */
	public function testBlankFilmThrowsException() {
		$process=$this->newProcess();
		$process->getFilmActors('Doesnt Exist');
	}
	public function testFilmHasActors() {
		$process=$this->newProcess();
		$actors=$process->getFilmActors('True Crime');
		$this->assertTrue(!empty($actors));
		$this->assertTrue(is_array($actors));
	}
	public function testOneFilmNoCommonBirthdaysReturnsEmptyArray() {
		$film='True Crime';
		$process=$this->newProcess();
		$birthday=$process->getFilmCommonBirthdays($film);
		$this->assertTrue(empty($birthday['date']));
		$this->assertTrue(empty($birthday['actors']));
		$this->assertEquals($birthday['film'],$film);
	}
	public function testOneFilmOneCommonBirthdayReturnsDateActors() {
		// in this film we have added a common birthday of 05-21 to 2 actors
		$film='Test Same';
		$process=$this->newProcess();
		$birthday=$process->getFilmCommonBirthdays($film);
		$this->assertEquals($birthday['date'],'05-21');
		$this->assertEquals(count($birthday['actors']),2);
		$this->assertEquals($birthday['film'],$film);
	}
	public function testOneFilmMultipleCommonBirthdayReturnsDateActors() {
		// in this film we have added a common birthday of 05-21 to 2 actors and of 04-18 to 3 actors
		$film='Test Same Multiple';
		$process=$this->newProcess();
		$birthday=$process->getFilmCommonBirthdays($film);
		$this->assertEquals($birthday['date'],'04-18');
		$this->assertEquals(count($birthday['actors']),3);
		$this->assertEquals($birthday['film'],$film);
	}
	public function testMultipleFilmsMultipleCommonBirthdayReturnsFilmDateActors() {
		// using existing data we should parse three films and return most birthdays. Should be Test Same Multiple
		$film='Test Same Multiple';
		$process=$this->newProcess();
		$birthday=$process->getCommonBirthdays();
		$this->assertEquals($birthday['date'],'04-18');
		$this->assertEquals(count($birthday['actors']),3);
		$this->assertEquals($birthday['film'],$film);
	}
	public function testMultipleFilmsNoCommonBirthdayReturnsEmptyArray() {
		// using existing data we should parse three films and return most birthdays
		$this->type='films-no-birthdays';
		$process=$this->newProcess();
		$birthday=$process->getCommonBirthdays();
		$this->assertEquals($birthday['date'],'');
		$this->assertEquals($birthday['actors'],'');
		$this->assertEquals($birthday['film'],'');
	}
}