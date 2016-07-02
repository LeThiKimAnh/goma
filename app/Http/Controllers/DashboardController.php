<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\DonHang;

class DashboardController extends Controller
{
    public function dashboard(){
    	$don_hang = DonHang::select('id','ma_don_hang','tong_gia','khach_hang','created_at')->orderBy('id','DESC')->get()->toArray();
    	$so_don_hang = count($don_hang);
    	$don_hang_daxl = DonHang::where('trang_thai',2)->orderBy('id','DESC')->get()->toArray();
    	$so_don_hang_daxl = count( $don_hang_daxl);
    	$data = array_slice($don_hang, 0,10);
    	$data_don_hang_daxl = array_slice($don_hang_daxl, 0,10);
    	$don_hang_chxl = DonHang::where('trang_thai',0)->orderBy('id','DESC')->get()->toArray();
    	$data_don_hang_chxl = array_slice($don_hang_chxl, 0,10);
    	return view('admin.index',compact('so_don_hang','so_don_hang_daxl','data','data_don_hang_daxl','data_don_hang_chxl'));
    }
}
