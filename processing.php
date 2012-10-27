<?php

class filmProcessing {
	public $data;
	function __construct($data) {
		$this->data=$this->decodeJSON($data);
	}
	public function decodeJSON($string) {
		// set $assoc = true to return an array
		return json_decode($string,true);
	}
}