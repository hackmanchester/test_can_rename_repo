<?php
include 'base.php';

// this is working differently from our other areas, as the pre-processing will already have done a lot of work for us; we just have a list of actors in films and we know the date is already sorted. Because of this we will have to take the date as an input to keep the return consistent

class ByDate extends ProcessingTests {
	protected $type='actors';
	private $actor='Clint Eastwood';
	private $date='05-21';

	protected function newProcess() {
		$json=$this->getJSON($this->type);
		return new actorProcessing($this->actor,$this->date,$json,true);
	}

	public function testConstructedWithDate() {
		$process=$this->newProcess();
		$this->assertEquals($process->date,$this->date);
	}
	public function testSingleActorReturnsFilms() {
		$process=$this->newProcess();
		$films=$process->getActorFilms($this->actor);
		$this->assertEquals(count($films),2);
	}
	public function testReturnsCommonFilmsWithChosenActor() {
		$process=$this->newProcess();
		$birthday=$process->getActorBirthdays();
		$this->assertEquals($birthday['date'],$this->date);
		$this->assertEquals(count($birthday['actors']),2);
		$this->assertEquals($birthday['film'],'Test Same');
	}
}