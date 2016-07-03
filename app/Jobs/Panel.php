<?php

namespace App\Jobs;

class Panel {

	public $width;
	public $height;
	public $area;
	public $req;
	private $filledArea = 0;
	private $root;
	private $mapped_rects = array();

	public function __construct($width, $height, $req) {
		$this->width = $width;
		$this->height = $height;
		$this->req = $req;

		$this->area = $width * $height;
		$this->root = new Node($width, $height, $req);
	}

	public function addAll($rects) {
		$remain_rects = array();

		while (count($rects)) {
			$rect = array_shift($rects);

			if ($this->root->insert($rect)) {
				#update filled area and mapped_rects
				$this->filledArea += $rect->area;
				array_push($this->mapped_rects, $rect);
			} else {
				array_push($remain_rects, $rect);
			}
		}
		return $remain_rects;
	}

	public function remain() {
		return $this->root->remain();
	}

	public function sketch() {
		$res = array();
		foreach ($this->mapped_rects as $rect) {
			array_push($res, $rect->sketch());
		}

		return $res;
	}

	public function draw() {
		// TODO iterate from root and draw it all to a buffer image
	}

}
