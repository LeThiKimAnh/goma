<?php

namespace App\Jobs;

class Node {

	protected $bound;
	protected $left;
	protected $right;
	protected $filled;
	protected $req;

	public function __construct($req) {
		$this->req = $req;
	}

	public function insert($rect) {
		if ($this->left != null) {
			return $this->left->insert($rect) || $this->right->insert($rect);
		}
		if ($this->filled) {
			return False;
		}
		$bound = $this->bound;

		$ww_rate = $rect->width / $bound->width;
		$hh_rate = $rect->height / $bound->height;
		$wh_rate = $rect->width / $bound->height;
		$hw_rate = $rect->height / $bound->width;

		if ($ww_rate == 1 and $hh_rate == 1) {
			$rect->placeAt($bound->top, $bound->left);
			$this->filled = True;
			return True;
		}
		if ($wh_rate == 1 and $hw_rate == 1 and $this->req == Solution::NONE) {
			$rect->placeAt($bound->top, $bound->left);
			$this->filled = True;
			$rect->rotate = True;
			return True;
		}

		if ($this->req == Solution::NONE) {
			// we can rotate the rect here
		}
		# TODO it will fit, chose the best way to rotate
		// create 2 child nodes
		$this->left = new Node($this->req);
		$this->right = new Node($this->req);

		// split verticaly
		$this->left->bound = new Rect($rect->width, $bound->height - $rect->height);
		$this->left->bound->placeAt($bound->left, $bound->top + $rect->height);

		$this->right->bound = new Rect($bound->width - $rect->width, $bound->height);
		$this->right->bound->placeAt($bound->left + $rect->width, $bound->top);

		$rect->placeAt($bound->top, $bound->left);
		return $rect;
	}

	public function remain() {
		// get all un-filled node and will be used as recyclee later
		if ($this->left == null) {
			return array($this->bound);
		}
		$left = $this->left->remain();
		$right = $this->right->remain();

		return array_merge($left, $right);
	}

}
