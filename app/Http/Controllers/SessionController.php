<?php

namespace App\Http\Controllers;

use App\Session;
use App\DonHang;
use App\Jobs\OptimizeSketch;
use Auth;

class SessionController extends Controller {

	public function session($id) {
		if (Auth::user()->level == 1 || Auth::user()->level == 2) {
			$don_hang = DonHang::find($id);
			$trang_thai = $don_hang->trang_thai;

			if ($trang_thai == 0) {
				$don_hang->trang_thai = 1;
				$don_hang->save();
				$session = new Session;
				$session->donhang_id = $id;
				$session->nguoi_xu_ly = Auth::user()->username;
				$session->trang_thai = 1;
				$session->sketch = '';
				$session->save();

				$this->dispatch(new OptimizeSketch($session));
				return redirect()->route('listDh')->with(['flash_level' => 'success', 'flash_message_success' => 'Đơn hàng đang chờ xử lý']);
			} else {
				return redirect()->route('listDh')->with(['flash_level' => 'success', 'flash_message' => 'Đơn hàng này đã hoặc đang đợi xử lý']);
			}
		} else {
			return view('errors.500');
		}
	}

	public function result($id) {
		if (Auth::user()->level == 1 || Auth::user()->level == 2 || Auth::user()->level == 4) {
			$session = Session::where('donhang_id', $id)->first();
			if ($session != null && $session->sketch != null) {
				$panels = json_decode($session->sketch)->panels;
				return view('admin.result', compact('session', 'panels'));
			} else {
				return view('errors.404');
			}
		} else {
			return view('errors.404');
		}
	}

}
