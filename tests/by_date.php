<?php
include 'base.php';

class ByDate extends ProcessingTests {
	protected $type='dates';

	protected function newProcess() {
		$json=$this->getJSON($this->type);
		return new dateProcessing($json,true);
	}

	// now we move on to actual callable functions
	/**
     * 
     * @expectedException Exception
     */
	public function testBlankDateThrowsException() {
		$process=$this->newProcess();
		$process->getDateActors('Doesnt Exist');
	}
	public function testDateHasActors() {
		$process=$this->newProcess();
		$actors=$process->getDateActors('05-21');
		$this->assertTrue(!empty($actors));
		$this->assertTrue(is_array($actors));
	}
	public function testOneDateNoCommonFilmsReturnsEmptyArray() {
		$date='06-21';
		$process=$this->newProcess();
		$birthday=$process->getDateCommonBirthdays($date);
		$this->assertTrue(empty($birthday['film']));
		$this->assertTrue(empty($birthday['actors']));
		$this->assertEquals($birthday['date'],$date);
	}
	public function testOneDateOneCommonFilmsReturnsBirthday() {
		$date='05-21';
		$process=$this->newProcess();
		$birthday=$process->getDateCommonBirthdays($date);
		$this->assertEquals($birthday['date'],$date);
		$this->assertEquals(count($birthday['actors']),2);
		$this->assertEquals($birthday['film'],'Test Same');
	}
	public function testOneDateMultipleCommonFilmsReturnsMostOccuringBirthday() {
		$date='07-21';
		$process=$this->newProcess();
		$birthday=$process->getDateCommonBirthdays($date);
		$this->assertEquals($birthday['date'],$date);
		$this->assertEquals(count($birthday['actors']),3);
		$this->assertEquals($birthday['film'],'The Matrix');
	}
}