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

	public function run($rects, $recyclees) {
		// sort all the rect by area desc
		usort($rects, function($rect1, $rect2) {
			return $rect2->area - $rect1->area;
		});
		// sort all the recyclee by area desc
		usort($recyclees, function($rect1, $rect2) {
			return $rect2->area - $rect1->area;
		});

		// foreach type of requirement, we pack it separately
		foreach (array(Solution::VERTICAL, Solution::HORIZONAL, Solution::NONE) as $req) {
			$sub_rects = array_filter($rects, function($rect) {
				return $rect->req == $req;
			});
			$sub_recyclees = array_filter($recyclees, function($rect) {
				return $rect->req == $req;
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

	private function runOnReq($rects, $recyclees, $req) {
		foreach ($recyclees as $r) {
			$panel = new Panel($r->width, $r->height, $req);
			// update remain rects 
			$rects = $panel->addAll($rects);

			if (count($rects) == 0) {
				break;
			}
			$remain = $panel->remain();
			array_push($this->panels, $panel);
			array_merge($this->remain, $remain);
		}
		while (count($rects) != 0) {
			$panel = new Panel(Solution::STANDARD_W, Solution::STANDARD_H, $req);
			$rects = $panel->addAll($rects);

			$remain = $panel->remain();
			array_push($this->panels, $panel);
			array_merge($this->remain, $remain);
		}
	}

}
