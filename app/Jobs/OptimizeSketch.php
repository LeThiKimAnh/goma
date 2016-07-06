<?php

namespace App\Jobs;

use Log;
use DB;
use App\Jobs\Job;
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
		$order_id = $this->session->donhang_id;
		$gothua = DB::select("SELECT dai as height,rong as width, chat_lieu as req FROM go_thua;");
		$sql = "SELECT c.ten as `code`, SUM(a.so_luong * b.so_luong) as count, c.dai as height, c.rong as width, c.yeu_cau as req FROM chi_tiet_vat_dung as a inner join chi_tiet_don_hang as b ON a.vatdung_id = b.vatdung_id and b.donhang_id = $order_id inner join vat_lieu as c ON a.vatlieu_id = c.id GROUP BY a.vatlieu_id;";
		$res = DB::select($sql);
		$rects = array();
		$recyclees = array();

		foreach ($res as $r) {
			$count = intval($r->count);
			for ($i = 0; $i < $count; $i++) {
				array_push($rects, new Rect(intval($r->width), intval($r->height), $r->code, intval($r->req)));
			}
		}

		echo '52: recyclee ' . count($gothua);

		foreach ($gothua as $r) {
			$r->width = intval($r->width);
			$r->height = intval($r->height);
			$r->req = intval($r->req);
			$r->area = $r->width * $r->height;

			array_push($recyclees, $r);
		}

		$solution = new Solution();
		$solution->run($rects, $recyclees);

		$sketch = $solution->to_json();
		$this->session->trang_thai = 2;
		DB::update("UPDATE `don_hang` SET `trang_thai` = 2 WHERE `id` = $order_id");

		$this->session->sketch = $sketch;
		$this->session->save();

		Log::info("Done!");
	}

}
