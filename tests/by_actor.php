<?php
include 'base.php';

class ByDate extends ProcessingTests {
	protected $type='dates';

	protected function newProcess() {
		$json=$this->getJSON($this->type);
		return new actorProcessing($json,true);
	}
}