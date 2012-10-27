<?php
include '../processing.php';

class ByFilm extends PHPUnit_Framework_TestCase {
	public function testLoadsJSONFile () {
		$json='"'.include 'films.json'.'"';
		$this->assertTrue(!empty($json));
	}
	public function testOneFilmNoCommonBirthdays () {
		$json='"'.include 'films.json'.'"';
	}
}