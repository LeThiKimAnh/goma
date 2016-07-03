<?php

namespace App\Jobs;

use Log;
use DB;
use App\GoThua;
use App\Jobs\Solution;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class OptimizeSketch extends Job implements ShouldQueue {

	use InteractsWithQueue,
	 SerializesModels;

	protected $session;

	/**
	 * Create a new job instance.
	 *
	 * @return void
	 */
	public function __construct($session) {
		$this->session = $session;
	}

	/**
	 * Execute the job.
	 *
	 * @return void
	 */
	public function handle() {
		Log::info("Starting optimze the session");
		$recyclees = DB::select("SELECT dai as height,rong as width, chat_lieu as req FROM goma.go_thua;");
		$sql = "SELECT c.ten as `code`, SUM(a.so_luong * b.so_luong) as count, c.dai as height, c.rong as width, c.yeu_cau as req FROM chi_tiet_vat_dung as a inner join chi_tiet_don_hang as b ON a.vatdung_id = b.vatdung_id and b.donhang_id = 2 inner join vat_lieu as c ON a.vatlieu_id = c.id GROUP BY a.vatlieu_id;";
		$res = DB::select($sql);
		$rects = array();

		foreach ($res as $r) {
			array_push($rects, new Rect($r['width'], $r['height'], $r['code'], $r['req']));
		}

		foreach ($recyclees as $r) {
			$r->area = $r->width * $r->height;
			array_push($rects, $r);
		}

		$solution = new Solution();
		$solution->run($rects, $recyclees);


		Log::info("Done!");
	}

}
