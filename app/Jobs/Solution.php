<?php

namespace App\Jobs;

use App\Jobs\Panel;

class Solution {

	const STANDARD_W = 2400;
	const STANDARD_H = 1200;
	const NONE = 0;
	const HORIZONAL = 1;
	const VERTICAL = 2;

	private $panels = array();
	private $remain = array();
	private $order_id;
	public static $REQS = array(Solution::VERTICAL, Solution::HORIZONAL, Solution::NONE);

	public function __construct($order_id) {
		$this->order_id = $order_id;
	}

	public function run($rects, $recyclees) {
		// foreach type of requirement, we pack it separately
		foreach (Solution::$REQS as $req) {
			$sub_rects = array_filter($rects, function($rect) use ($req) {
				return $rect->req == $req;
			});
			$sub_recyclees = array_filter($recyclees, function($rect) use ($req) {
				return $rect->req == $req;
			});

			// sort all the rect
			usort($sub_rects, function($rect1, $rect2) use($req) {
				if ($req == 0) {
					return max($rect2->width, $rect2->height) - max($rect1->width, $rect1->height);
				} else {
					return $rect2->width - $rect1->width;
				}
			});
			// sort all the recyclee
			usort($sub_recyclees, function($rect1, $rect2) use($req) {
				if ($req == 0) {
					return max($rect2->width, $rect2->height) - max($rect1->width, $rect1->height);
				} else {
					return $rect1->width - $rect2->width;
				}
			});
			$this->runOnReq($sub_rects, $sub_recyclees, $req);
		}
	}

	public function panels() {
		return $this->panels;
	}

	public function remain() {
		return $this->remain;
	}

	public function sketch() {
		$sketch = array();
		$id = 1;
		foreach ($this->panels as $p) {
			$p_sketch = $p->sketch();
			$p_sketch['id'] = 'panel_' . $this->order_id . '_' . $id++;
			array_push($sketch, $p_sketch);
		}
		$obj = array(
			"panels" => $sketch,
			"remain" => $this->remain
		);

		return $obj;
	}

	public function to_json() {
		$sketch = $this->sketch();
		return json_encode($sketch);
	}

	private function runOnReq($rects, $recyclees, $req) {
		if (count($rects) == 0) {
			return;
		}

		foreach ($recyclees as $r) {
			$panel = new Panel($r->width, $r->height, $req);
			// update remain rects 
			$rects = $panel->addAll($rects);

			$remain = $panel->remain();
			array_push($this->panels, $panel);
			$this->remain = array_merge($this->remain, $remain);

			if (count($rects) == 0) {
				break;
			}
		}

		while (count($rects) != 0) {
			$panel = new Panel(Solution::STANDARD_W, Solution::STANDARD_H, $req);
			$rects = $panel->addAll($rects);

			$remain = $panel->remain();
			array_push($this->panels, $panel);
			$this->remain = array_merge($this->remain, $remain);
		}
	}

}
