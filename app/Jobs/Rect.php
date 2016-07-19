<?php

namespace App\Jobs;

class Rect {

	public $top;
	public $left;
	public $width;
	public $height;
	public $code;
	public $area;
	public $req;
	public $rotate;

	public function __construct($width, $height, $code, $req) {
		$this->width = $width;
		$this->height = $height;
		$this->rotate = False;
		$this->code = $code;
		$this->req = $req;

		$this->area = $width * $height;
	}

	public function placeAt($top, $left) {
		$this->top = $top;
		$this->left = $left;
	}

	public function sketch() {
		return array($this->top, $this->left, $this->width, $this->height, $this->code);
	}

	public function draw() {
		// TODO iterate from root and draw it all to a buffer image
	}

}
