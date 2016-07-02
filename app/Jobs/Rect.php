<?php
namespace App\Jobs;

class Rect {

	private $top;
	private $left;
	public $width;
	public $height;
	public $area;

	public function _construct($width, $height) {
		$this->width = $width;
		$this->height = $height;

		$this->area = $width * $height;
	}

	public function place($top, $left) {
		$this->top = $top;
		$this->left = $left;
	}

}
