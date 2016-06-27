<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\VatDung;
use App\VatLieu;
use App\DonHang;
use App\ChiTietVatDung;
use App\ChiTietDonHang;

use App\Http\Requests\DonHangRequest;


function length($array){
   $length = 0;
  foreach ($array as $value) {
    $length = $length+1;
  }
  return $length;
}

function check($array,$key){
   if(in_array($key,$array)){
     return 1;     
   }else{

     return 0;
   }
}

class DonHangController extends Controller
{
    public function get_themDonHang(){
    	$data = VatDung::select('id','ten')->get()->toArray();
        $tb = "vật dụng";
        $controller = 'Đơn Hàng';
        if(length($data)>0){
            return view('admin.donhang.add',compact('data'));
        }else{
             return view('admin.blocks.thongbao',compact('tb','controller'));
        }
    	
    }
    public function post_DonHang(DonHangRequest $request){
        $vatdung_id_mang = $request->vatdung;
        $soluong_mang = $request->soLuong;
        if((check($vatdung_id_mang,0)==0)&&(check($soluong_mang,'')==0)){
            $cout = DonHang::max('id');
        	$don_hang = new DonHang;
        	$don_hang ->khach_hang = $request ->txt_KH;
            $don_hang->ma_don_hang = "DH".($cout+1);
        	$don_hang ->nguoi_tao_don = "Lê Kim Anh";
        	$don_hang ->trang_thai = 0;
        	$don_hang -> save();
        	$donhang_id = $don_hang->id;
            for($i = 0;$i<length($vatdung_id_mang);$i++){
                $chi_tiet_dh = new ChiTietDonHang;
                $chi_tiet_dh->donhang_id = $donhang_id;
                $chi_tiet_dh->vatdung_id = $vatdung_id_mang[$i];
                $chi_tiet_dh->so_luong = $soluong_mang[$i];
                $chi_tiet_dh->save();
            }
        	return redirect()->route('listDh')->with(['flash_level'=>'success','flash_message'=>'Success !! Đã thêm thành công đơn hàng']);
        }
        if((check($vatdung_id_mang,0)==0)&&(check($soluong_mang,'')==1)){
            return redirect()->route('getDonhang')->with(['flash_level'=>'success','flash_message'=>'Cảnh báo !! Bạn chưa điền số lượng vật dụng']);
        }
        if((check($vatdung_id_mang,0)==1)&&(check($soluong_mang,'')==0)){
            return redirect()->route('getDonhang')->with(['flash_level'=>'success','flash_message'=>'Cảnh báo !! Bạn chưa chọn đầy đủ vật dung']);
        }
        
        return redirect()->route('getDonhang')->with(['flash_level'=>'success','flash_message'=>'Cảnh báo !! Tối thiểu phải có một vật dụng trong đơn hàng']);
        
    }
    public function list(){
        $data = DonHang::select('id','khach_hang','nguoi_tao_don','mo_ta','trang_thai','ma_don_hang')->get()->toArray();
        return view('admin.donhang.list',compact('data'));
    }
    public function delete($id){
        $don_hang = DonHang::find($id);
        $don_hang->delete();
        return redirect()->route('listDh')->with(['flash_level'=>'success','flash_message'=>'Success !! Đã xóa thành công đơn hàng']);
    }
    public function getEdit($id){
        $data = VatDung::select('id','ten')->get()->toArray();
        $don_hang = DonHang::find($id);
        return view('admin.donhang.edit',compact('data','don_hang'));
    }
    public function postEdit(Request $request,$id){
        $this->validate($request,
            ['txt_KH'=>'required'],
            ["txt_KH.required"=>"Xin hãy nhập tên khách hàng!!"]
            );
        $vatdung_id_mang = $request->vatdung;
        $soluong_mang = $request->soLuong;
        if((check($vatdung_id_mang,0)==0)&&(check($soluong_mang,'')==0)){
            $don_hang =  DonHang::find($id);
            $don_hang ->khach_hang = $request ->txt_KH;
            $don_hang ->nguoi_tao_don = "Lê Kim Anh";
            $don_hang ->trang_thai = 0;
            $don_hang -> save();

            $chitiet = ChiTietDonHang::where('donhang_id','=',$id);
            $chitiet->delete();

            for($i = 0;$i<length($vatdung_id_mang);$i++){
                $chi_tiet_dh = new ChiTietDonHang;
                $chi_tiet_dh->donhang_id =$id;
                $chi_tiet_dh->vatdung_id = $vatdung_id_mang[$i];
                $chi_tiet_dh->so_luong = $soluong_mang[$i];
                $chi_tiet_dh->save();
            }
            return redirect()->route('listDh')->with(['flash_level'=>'success','flash_message'=>'Success !! Đã thêm thành công đơn hàng']);
        }
        if((check($vatdung_id_mang,0)==0)&&(check($soluong_mang,'')==1)){
            return redirect()->route('getEditDH',$id)->with(['flash_level'=>'success','flash_message'=>'Cảnh báo !! Bạn chưa điền số lượng vật dụng']);
        }
        if((check($vatdung_id_mang,0)==1)&&(check($soluong_mang,'')==0)){
            return redirect()->route('getEditDH',$id)->with(['flash_level'=>'success','flash_message'=>'Cảnh báo !! Bạn chưa chọn đầy đủ vật dụng']);
        }
        
        return redirect()->route('getEditDH',$id)->with(['flash_level'=>'success','flash_message'=>'Cảnh báo !! Tối thiểu phải có một vật dụng trong đơn hàng']);
    }
    public function chitiet($id){
        $don_hang = DonHang::find($id);
        $chi_tiet_dh = ChiTietDonHang::where('donhang_id','=',$id)->get()->toArray();
        return view('admin.donhang.chitiet',compact('don_hang','chi_tiet_dh','id'));
    }
}
