<?php

namespace App\Jobs;

class Node {

	protected $bound;
	protected $left;
	protected $right;
	protected $filled;
	protected $req;
	protected $level = 0;
	protected $gap = 4;

	public function __construct($width, $height, $req) {
		$this->req = $req;

		$this->bound = new \stdClass();
		$this->bound->top = 0;
		$this->bound->left = 0;
		$this->bound->width = $width;
		$this->bound->height = $height;
	}

	public function insert($rect) {
		$bound = $this->bound;

		$ww_diff = $bound->width - $rect->width;
		$hh_diff = $bound->height - $rect->height;
		$wh_diff = $bound->height - $rect->width;
		$hw_diff = $bound->width - $rect->height;

		if ($ww_diff < 0 or $hh_diff < 0) {
			echo 'early return';
			return False;
		}

		if ($this->left != null) {
			echo 'left node';
			$ret = $this->left->insert($rect);
			if ($ret) {
				return $ret;
			}
		}
		if ($this->right != null) {
			echo 'right node';
			return $this->right->insert($rect);
		}
		if ($this->filled) {
			return False;
		}
		echo 'level > ' . $this->level . ' > bound';
		var_dump($bound->top, $bound->left, $bound->width, $bound->height);

		if ($ww_diff == 0 and $hh_diff == 0) {
			$rect->placeAt($bound->top, $bound->left);
			$this->filled = True;
			return True;
		}
//		if ($wh_diff == 1 and $hw_diff == 1 and $this->req == Solution::NONE) {
//			$rect->placeAt($bound->top, $bound->left);
//			$this->filled = True;
//			$rect->rotate = True;
//			return True;
//		}

		if ($this->req == Solution::NONE) {
			// we can rotate the rect here
		}
		# TODO it will fit, chose the best way to rotate
		// create 2 child nodes
		// split verticaly
//		if ($hh_diff > 0) {
		$this->left = new Node($rect->width, $hh_diff, $this->req);
		$this->left->level = $this->level + 1;

		$this->left->bound->left = $bound->left;
		$this->left->bound->top = $bound->top + $rect->height;
//		}
//		if ($ww_diff > 0) {
		$this->right = new Node($ww_diff, $bound->height, $this->req);
		$this->right->level = $this->level + 1;

		$this->right->bound->left = $bound->left + $rect->width;
		$this->right->bound->top = $bound->top;
//		}
		$rect->placeAt($bound->top, $bound->left);
		echo 'rect';
		var_dump($rect->top, $rect->left, $rect->width, $rect->height);
		echo '=========================';
		return $rect;
	}

	public function remain() {
		// get all un-filled node and will be used as recyclee later
		if ($this->left == null && $this->right == null) {
			return array($this->bound);
		}
		$left = array();
		$right = array();

		if ($this->left != null) {
			$left = $this->left->remain();
		}
		if ($this->right != null) {
			$right = $this->right->remain();
		}

		return array_merge($left, $right);
	}

}
