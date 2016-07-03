<?php

namespace App\Http\Controllers;

use App\Session;
use App\DonHang;
use App\Jobs\OptimizeSketch;
use Auth;

class SessionController extends Controller
{
    public function session($id){
    	$don_hang = DonHang::find($id);
    	$don_hang->trang_thai = 1;
    	$don_hang->save();
    	
    	$session = new Session;
    	$session->donhang_id = $id;
        $session->nguoi_xu_ly = Auth::user()->username;
    	$session->trang_thai = 1;
    	$session->sketch = '';
    	$session->save();
    	
		$job = new OptimizeSketch($session);
		$job->delay(3600);
		
    	$this->dispatch($job);
    	return redirect()->route('listDh')->with(['flash_level'=>'success','flash_message'=>'Đơn hàng đang chờ xử lý']);
    }
}
