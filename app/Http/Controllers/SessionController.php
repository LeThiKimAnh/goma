<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Session;
use App\DonHang;
use App\Jobs\OptimizeSketch;

class SessionController extends Controller
{
    public function session($id){
    	$don_hang = DonHang::find($id);
    	$don_hang->trang_thai = 1;
    	$don_hang->save();
    	
    	$session = new Session;
    	$session->donhang_id = $id;
        $session->nguoi_xu_ly = 'Kim Anh';
    	$session->trang_thai = 1;
    	$session->sketch = '';
    	$session->save();
    	
    	$this->dispatch(new OptimizeSketch($session));
    	return redirect()->route('listDh')->with(['flash_level'=>'success','flash_message'=>'Xin bạn chờ kết quả']);
    }
}
