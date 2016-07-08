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
	public static $REQS = array(Solution::VERTICAL, Solution::HORIZONAL, Solution::NONE);

	public function run($rects, $recyclees) {
		// sort all the rect by area desc
		usort($rects, function($rect1, $rect2) {
//			return $rect2->area - $rect1->area;
			return max($rect2->width, $rect2->height) - max($rect1->width, $rect1->height);
		});
		// sort all the recyclee by area desc
		usort($recyclees, function($rect1, $rect2) {
//			return $rect2->area - $rect1->area;
			return max($rect2->width, $rect2->height) - max($rect1->width, $rect1->height);
		});

		// foreach type of requirement, we pack it separately
		foreach (Solution::$REQS as $req) {
			$sub_rects = array_filter($rects, function($rect) use ($req) {
				return $rect->req == $req;
			});
			$sub_recyclees = array_filter($recyclees, function($rect) use ($req) {
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

	public function to_json() {
		$sketch = array();
		foreach ($this->panels as $p) {
			array_push($sketch, $p->sketch());
		}
		var_dump($this->remain);
		$obj = array(
			"panels" => $sketch,
			"remain" => $this->remain
		);

		return json_encode($obj);
	}

	private function runOnReq($rects, $recyclees, $req) {
		if (count($rects) == 0) {
			return;
		}
		echo 'Running on recyclee ' . count($recyclees) . '';
		foreach ($recyclees as $r) {
			$panel = new Panel($r->width, $r->height, $req);
			// update remain rects 
			echo 'Solution rects ' . count($rects) . '';
			$rects = $panel->addAll($rects);
			echo 'Solution rects ' . count($rects) . '';

			if (count($rects) == 0) {
				break;
			}
			$remain = $panel->remain();
			array_push($this->panels, $panel);
			array_merge($this->remain, $remain);
		}

		echo 'Creating new panel to add ';
		while (count($rects) != 0) {
			$panel = new Panel(Solution::STANDARD_W, Solution::STANDARD_H, $req);
			$rects = $panel->addAll($rects);

			$remain = $panel->remain();
			echo 'panel remain';
			var_dump($remain);
			array_push($this->panels, $panel);
			$this->remain = array_merge($this->remain, $remain);
		}

		echo 'Remain =>';
		var_dump($this->remain);
	}

}
