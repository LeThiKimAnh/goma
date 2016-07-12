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
        $trang_thai = $don_hang->trang_thai;

        if($trang_thai==0){
        	$don_hang->trang_thai = 1;
        	$don_hang->save();
        	$session = new Session;
        	$session->donhang_id = $id;
            $session->nguoi_xu_ly = Auth::user()->username;
        	$session->trang_thai = 1;
        	$session->sketch = '';
        	$session->save();
        	
        	$this->dispatch(new OptimizeSketch($session));
        	return redirect()->route('listDh')->with(['flash_level'=>'success','flash_message_success'=>'Đơn hàng đang chờ xử lý']);
        }else{
            return redirect()->route('listDh')->with(['flash_level'=>'success','flash_message'=>'Đơn hàng này đã hoặc đang đợi xử lý']);
        }
    }
    public function result($id){
        
        return view('admin.result');
    }
}
