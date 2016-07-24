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
			return False;
		}

		// ensure the node has no child
		if ($this->left != null || $this->right != null) {
			// if it has child, it must not take part in this situation
			// only its children can
			if ($this->left != null) {
				$ret = $this->left->insert($rect);
				if ($ret) {
					return $ret;
				}
			}
			if ($this->right != null) {
				return $this->right->insert($rect);
			}
			return False;
		}

		if ($this->filled) {
			return False;
		}

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

		if ($hh_diff > 0) {
			$this->left = new Node($rect->width, $hh_diff, $this->req);
			$this->left->level = $this->level + 1;

			$this->left->bound->left = $bound->left;
			$this->left->bound->top = $bound->top + $rect->height;
		}
		if ($ww_diff > 0) {
			$this->right = new Node($ww_diff, $bound->height, $this->req);
			$this->right->level = $this->level + 1;

			$this->right->bound->left = $bound->left + $rect->width;
			$this->right->bound->top = $bound->top;
		}
		$rect->placeAt($bound->top, $bound->left);
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
