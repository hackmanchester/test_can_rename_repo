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

	public function testLoadsJSONFile () {
		$json=$this->getJSON($this->type);
		$this->assertTrue(!empty($json));
	}
	public function testValidJSON () {
		$json=$this->getJSON($this->type);
		$array=filmProcessing::decodeJSON($json);
		$this->assertTrue(!empty($array));
		$this->assertTrue(is_array($array));
	}
	public function testConstructor () {
		$json=$this->getJSON($this->type);
		$process=new filmProcessing($json);
		$this->assertTrue(!empty($process->data));
		$this->assertTrue(is_array($process->data));
	}
}