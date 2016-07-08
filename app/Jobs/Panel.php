<?php

namespace App\Jobs;

class Panel1 {

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
				echo 'placed ';
				var_dump($rect->top, $rect->left, $rect->width, $rect->height);
				echo '=================';
				$this->filledArea += $rect->area;
				array_push($this->mapped_rects, $rect);
			} else {
				array_push($remain_rects, $rect);
				echo 'ignored';
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

class Bound {

	public $top;
	public $left;
	public $width;
	public $height;

	public function __construct($top, $left, $width, $height) {
		$this->top = $top;
		$this->left = $left;
		$this->width = $width;
		$this->height = $height;
	}

	public function sketch() {
		return array($this->top, $this->left, $this->width, $this->height);
	}

}

class Panel {

	public $width;
	public $height;
	public $area;
	public $req;
	public $bound;
	private $mapped_rects;
	public $gap = 4;

	public function __construct($width, $height, $req) {
		$this->width = $width;
		$this->height = $height;
		$this->req = $req;

		$this->area = $width * $height;
		$this->bound = new Bound(0, 0, $width, $height);
		$this->mapped_rects = array();
		$this->stack = array();

		// add its bound to stack
		array_push($this->stack, $this->bound);
	}

	public function addAll($rects) {
		echo 'add all ' . count($rects);
		$remain_rects = array();
		foreach ($rects as $rect) {
			if ($this->tryInsert($rect)) {
				echo 'placed';
				print_r($rect->sketch());
				array_push($this->mapped_rects, $rect);
			} else {
				echo 'ignored';
				array_push($remain_rects, $rect);
			}
		}
		return $remain_rects;
	}

	public function tryInsert($rect) {
		$gap = $this->gap;
		$stack = $this->stack;
		$queue = array();
		$res = False;

		while (count($stack)) {
			$bound = array_pop($stack);

			var_dump($bound);

			$ww_diff = $bound->width - $rect->width;
			$hh_diff = $bound->height - $rect->height;
			$wh_diff = $bound->height - $rect->width;
			$hw_diff = $bound->width - $rect->height;

			if ($ww_diff < 0 or $hh_diff < 0) {
				// this bound can't fit this rect
				echo 'not fit \n';
				array_unshift($queue, $bound);
				continue;
			}
			// place this rect on this bound
			$res = True;
			$rect->placeAt($bound->top, $bound->left);
			// create new sub bound if need
			if ($hh_diff > 0) {
				$left = new Bound($bound->top + $rect->height + $gap, $bound->left, $rect->width, $hh_diff - $gap);
				echo '\n left';
				var_dump($left);
				array_unshift($queue, $left);
			}
			if ($ww_diff > 0) {
				$right = new Bound($bound->top, $bound->left + $rect->width + $gap, $ww_diff - $gap, $bound->height);
				echo '\n right';
				var_dump($right);
				array_unshift($queue, $right);
			}

			break;
		}

		// push all the queue into stack
		$this->stack = array_merge($stack, $queue);
		return $res;
	}

	public function sketch() {
		return array(
			"rects" => $this->map(),
			"remains" => $this->remain()
		);
	}
	
	public function map() {
		$res = array();
		foreach ($this->mapped_rects as $rect) {
			array_push($res, $rect->sketch());
		}

		return $res;
	}

	public function remain() {
		$res = array();
		foreach ($this->stack as $bound) {
			echo 'panel->empty';
			array_push($res, $bound->sketch());
		}

		return $res;
	}

}
