<?php

namespace App\Jobs;

class Rect {

	private $top;
	private $left;
	public $width;
	public $height;
	public $area;
	public $rotate;

	public function _construct($width, $height) {
		$this->width = $width;
		$this->height = $height;
		$this->rotate = False;

		$this->area = $width * $height;
	}

	public function placeAt($top, $left) {
		$this->top = $top;
		$this->left = $left;
	}

	public function sketch() {
		// TODO generate the sketch as a string
	}

	public function draw() {
		// TODO iterate from root and draw it all to a buffer image
	}

}
