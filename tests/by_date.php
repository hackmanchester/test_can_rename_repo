<?php
include 'base.php';

class ByDate extends ProcessingTests {
	private $type='dates';

	private function newProcess() {
		$json=$this->getJSON($this->type);
		return new dateProcessing($json,true);
	}

}