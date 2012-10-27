<?php
include '../processing.php';

class ByFilm extends PHPUnit_Framework_TestCase {
	private $type='films';

	// these are only needed for testing, as real class will have these passed in constructor or method calls
	private function getJSON($file) {
		$file.='.json';
		$fh=fopen($file,'r');
		if (!empty($fh)) {
			$json=fread($fh,filesize($file));
			fclose($fh);
		}
		return $json;
	}
	private function getJSONFormatted($file) {
		$json=$this->getJSON($file);
		return '"'.$json.'"';
	}

	public function testLoadsJSONFile () {
		$json=$this->getJSON($this->type);
		$this->assertTrue(!empty($json));
	}
	public function testValidJSON () {
		$json=$this->getJSON($this->type);
		$array=json_decode($json);
		$this->assertTrue(!empty($array));
	}
}