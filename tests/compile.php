<?php
include '../compiling.php';

class ControllerTests extends PHPUnit_Framework_TestCase {
	protected $date_input=array('date'=>'05-21');
	protected $film_input=array('film'=>'The Matrix');
	protected $actor_input=array('actor'=>'Clint Eastwood');
	private function _is_2d_array($arr) {
		return is_array(reset($data));
	}

	// setup and routing tests
	public function testNoInputReturnsBlank () {
		$controller=new Controller($_GET);
		$this->assertEquals($controller->output,false);
	}
	public function testDateInputChoosesDate() {
		$controller=new Controller($date_input);
		$this->assertEquals($controller->output,'date');
	}
	public function testFilmInputChoosesFilm() {
		$controller=new Controller($film_input);
		$this->assertEquals($controller->output,'film');
	}
	public function testActorInputChoosesActor() {
		$controller=new Controller($actor_input);
		$this->assertEquals($controller->output,'actor');
	}

	public function testDateInputReturnsActorsAfterFirstStage() {
		$controller=new Controller($date_input);
		$data=$controller->data['actors'];
		$this->assertTrue(!empty($data));
		$this->assertTrue(is_array($data));
	}
	public function testDateInputReturnsFilmsAfterSecondStage() {
		$controller=new Controller($date_input);
		$data=$controller->data['actors_films'];
		$this->assertTrue(!empty($data));
		$this->assertTrue(is_array($data));
		$this->assertTrue(_is_2d_array($data));
	}
	public function testDateInputStartsDateProcessor() {
		$controller=new Controller($date_input);
		$this->assertTrue($controller->processor instanceof dateProcessing);
	}

	public function testFilmInputReturnsActorsAfterFirstStage() {
		$controller=new Controller($film_input);
		$data=$controller->data['actors'];
		$this->assertTrue(!empty($data));
		$this->assertTrue(is_array($data));
	}
	public function testFilmInputReturnsDatesAfterSecondStage() {
		$controller=new Controller($date_input);
		$data=$controller->data['actors_dates'];
		$this->assertTrue(!empty($data));
		$this->assertTrue(is_array($data));
		$this->assertTrue(_is_2d_array($data));
	}
	public function testFilmInputStartsFilmProcessor() {
		$controller=new Controller($date_input);
		$this->assertTrue($controller->processor instanceof filmProcessing);
	}

	public function testActorInputReturnsDateAfterFirstStage() {
		$controller=new Controller($actor_input);
		$data=$controller->data['date'];
		$this->assertTrue(!empty($data));
	}
	public function testActorInputReturnsActorsAfterSecondStage() {
		$controller=new Controller($actor_input);
		$data=$controller->data['actors'];
		$this->assertTrue(!empty($data));
		$this->assertTrue(is_array($data));
	}
	public function testActorInputReturnsFilmsAfterThirdStage() {
		$controller=new Controller($actor_input);
		$data=$controller->data['actors_films'];
		$this->assertTrue(!empty($data));
		$this->assertTrue(is_array($data));
		$this->assertTrue(_is_2d_array($data));
	}
	public function testActorInputStartsActorProcessor() {
		$controller=new Controller($actor_input);
		$this->assertTrue($controller->processor instanceof actorProcessing);
	}
}