<?php
include '../processing.php';

class ByFilm extends PHPUnit_Framework_TestCase {
	private $type='films';

	// this is only needed for testing, as real class will have these passed in constructor or method calls
	private function getJSON($file) {
		$file.='.json';
		$fh=fopen($file,'r');
		if (!empty($fh)) {
			$json=fread($fh,filesize($file));
			fclose($fh);
		}
		return $json;
	}
	private function newProcess() {
		$json=$this->getJSON($this->type);
		return new filmProcessing($json);
	}

	public function testLoadsJSONFile() {
		$json=$this->getJSON($this->type);
		$this->assertTrue(!empty($json));
	}
	public function testValidJSON() {
		$json=$this->getJSON($this->type);
		$array=filmProcessing::_decodeJSON($json);
		$this->assertTrue(!empty($array));
		$this->assertTrue(is_array($array));
	}
	public function testConstructor() {
		$process=$this->newProcess();
		$this->assertTrue(!empty($process->data));
		$this->assertTrue(is_array($process->data));
	}
	public function testRemoveYear() {
		$date='2012-10-27';
		$date=filmProcessing::_removeYear($date);
		$this->assertEquals($date,'10-27');
	}

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
}