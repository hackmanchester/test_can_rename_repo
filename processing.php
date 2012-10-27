<?php

class processing {
	public $data;

	function __construct($data,$json=false) {
		$this->data=$json ? $this->_decodeJSON($data) : $data;
	}
	public function _decodeJSON($string) {
		// set $assoc = true to return an array
		return json_decode($string,true);
	}
	public function _removeYear($date) {
		return substr_count($date,'-')==2 ? substr($date,5) : $date;
	}
}

include 'processing_films.php';
include 'processing_dates.php';
