<?php

namespace App\Jobs;

class Panell {

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

	public function sketch($req = 0) {
		return array($this->top, $this->left, $this->width, $this->height, $req);
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
		$remain_rects = array();
		foreach ($rects as $rect) {
			if ($this->tryInsert($rect)) {
				array_push($this->mapped_rects, $rect);
			} else {
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

			$ww_diff = $bound->width - $rect->width;
			$hh_diff = $bound->height - $rect->height;
			$wh_diff = $bound->height - $rect->width;
			$hw_diff = $bound->width - $rect->height;

			if ($this->req == 0 and $wh_diff >= 0 and $hw_diff >= 0 and
					($bound->width < 100 or $bound->height < 100 or
					($rect->width < 100 and $rect->height < 100))) {
				// rotate it
				$temp = $rect->width;
				$rect->width = $rect->height;
				$rect->height = $temp;

				$ww_diff = $hw_diff;
				$hh_diff = $wh_diff;

				$res = True;
				$rect->placeAt($bound->top, $bound->left);

				// split horizonaly
				if ($ww_diff > $gap) {
					$left = new Bound($bound->top, $bound->left + $rect->width + $gap, $ww_diff - $gap, $rect->height);
					array_unshift($queue, $left);
				}
				if ($hh_diff > $gap) {
					$right = new Bound($bound->top + $rect->height + $gap, $bound->left, $bound->width, $hh_diff - $gap);
					array_unshift($queue, $right);
				}

				break;
			}
			if ($ww_diff < 0 or $hh_diff < 0) {
				// this bound can't fit this rect
				array_unshift($queue, $bound);
				continue;
			}
			// place this rect on this bound
			$res = True;
			$rect->placeAt($bound->top, $bound->left);
			// split vertically
			if ($hh_diff > $gap) {
				$left = new Bound($bound->top + $rect->height + $gap, $bound->left, $rect->width, $hh_diff - $gap);
				array_unshift($queue, $left);
			}
			if ($ww_diff > $gap) {
				$right = new Bound($bound->top, $bound->left + $rect->width + $gap, $ww_diff - $gap, $bound->height);
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
			"width" => $this->width,
			"height" => $this->height,
			"req" => $this->req,
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
			array_push($res, $bound->sketch($this->req));
		}

		return $res;
	}

}
