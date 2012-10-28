<?php
include '../processing.php';

class ProcessingTests extends PHPUnit_Framework_TestCase {
	// this is only needed for testing, as real class will have these passed in constructor or method calls
	protected function getJSON($file) {
		$file.='.json';
		$fh=fopen($file,'r');
		if (!empty($fh)) {
			$json=fread($fh,filesize($file));
			fclose($fh);
		}
		return $json;
	}

	// first we'll test basic parsing, constructing and utility functions
	public function testLoadsJSONFile() {
		$json=$this->getJSON($this->type);
		$this->assertTrue(!empty($json));
	}
	public function testValidJSON() {
		$json=$this->getJSON($this->type);
		$array=processing::_decodeJSON($json);
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
		$date=processing::_removeYear($date);
		$this->assertEquals($date,'10-27');
	}
	public function testRemoveYearWithNoYear() {
		$date='10-27';
		$date=processing::_removeYear($date);
		$this->assertEquals($date,'10-27');
	}
}