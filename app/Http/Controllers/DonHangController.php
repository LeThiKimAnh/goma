<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\VatDung;
use App\VatLieu;
use App\DonHang;
use App\ChiTietVatDung;
use App\ChiTietDonHang;
use Auth;
use DB;

use App\Http\Requests\DonHangRequest;

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
        if(count($data)>0){
            return view('admin.donhang.add',compact('data'));
        }else{
             return view('admin.blocks.thongbao',compact('tb','controller'));
        }
        
    	
    }
    public function post_DonHang(DonHangRequest $request){

        $vatdung_id_mang_get = $request->vatdung;
        $soluong_mang_get = $request->soLuong;
        $vatdung_id_mang = array_slice($vatdung_id_mang_get, 1,count($vatdung_id_mang_get)-1);
        $soluong_mang =array_slice($soluong_mang_get, 1,count($soluong_mang_get)-1);
        if(count(array_unique($vatdung_id_mang))<count($vatdung_id_mang)){
            return redirect()->route('getDonhang')->with(['flash_level'=>'success','flash_message'=>'Cảnh báo !! không thể chọn hai lần 1 vật dụng']);
        }else{
            if((check($vatdung_id_mang,0)==0)&&(check($soluong_mang,'')==0)){
            $cout = DonHang::max('id');
            $don_hang = new DonHang;
            $don_hang ->khach_hang = $request ->txt_KH;
            $don_hang->ma_don_hang = "DH".($cout+1);
            $don_hang ->nguoi_tao_don = Auth::user()->username;
            $time = strtotime( $request ->date);
            $don_hang ->ngay_giao_hang =  date('Y-m-d', $time);
            $don_hang ->trang_thai = 0;
            $don_hang -> save();
            $donhang_id = $don_hang->id;

            $tong_gia = 0;

            for($i = 0;$i<count($vatdung_id_mang);$i++){
                $chi_tiet_dh = new ChiTietDonHang;
                $chi_tiet_dh->donhang_id = $donhang_id;
                $chi_tiet_dh->vatdung_id = $vatdung_id_mang[$i];
                $chi_tiet_dh->so_luong = $soluong_mang[$i];
                $chi_tiet_dh->save();

                $vat_dung = VatDung::find($vatdung_id_mang[$i]);
                $tong_gia = $tong_gia+($vat_dung['don_gia']+$vat_dung['phu_phi'])*$soluong_mang[$i];
            }
            $don_hang = DonHang::find($donhang_id);
            $don_hang->tong_gia = $tong_gia;
            $don_hang->save();

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
    }
    public function listDh(){
        $action = 'List';
        $data = DonHang::select('id','khach_hang','nguoi_tao_don','mo_ta','trang_thai','ma_don_hang','tong_gia','ngay_giao_hang')->orderBy('id','DESC')->get()->toArray();
        return view('admin.donhang.list',compact('data','action'));
    }
    public function deleteDH($id){
        $don_hang = DonHang::find($id);
        if($don_hang['trang_thai']==0){
             $don_hang->delete();
            return redirect()->route('listDh')->with(['flash_level'=>'success','flash_message'=>'Success !! Đã xóa thành công đơn hàng']);
        }else{
            return redirect()->route('listDh')->with(['flash_level'=>'success','flash_message'=>'Cảnh báo!! Đơn hàng này đã xử lý hoặc đang đợi xử lý, bạn không thể xóa được']);
        }
       
    }
    public function getEdit($id){
        $don_hang = DonHang::find($id);
        if($don_hang['trang_thai']==0){
            $data = VatDung::select('id','ten')->get()->toArray();
            $vatdungs = DB::table('chi_tiet_don_hang')->join('vat_dung','vat_dung.id','=','chi_tiet_don_hang.vatdung_id')->where('chi_tiet_don_hang.donhang_id','=',$id)->get();
            return view('admin.donhang.edit',compact('data','don_hang','vatdungs'));
        }else{
            return redirect()->route('listDh')->with(['flash_level'=>'success','flash_message'=>'Cảnh báo !! Đơn hàng này đã hoặc đang chờ xử lý, không được sửa ^_^']);
        }
    }
    public function postEdit(Request $request,$id){
        $this->validate($request,
            ['txt_KH'=>'required'],
            ["txt_KH.required"=>"Xin hãy nhập tên khách hàng!!"]
            );
        $vatdung_id_mang = $request->vatdung;
        $soluong_mang = $request->soLuong;
        if((check($vatdung_id_mang,0)==0)&&(check($soluong_mang,'')==0)){

            $chitiet = ChiTietDonHang::where('donhang_id','=',$id);
            $chitiet->delete();

            $tong_gia = 0;

            for($i = 0;$i<count($vatdung_id_mang);$i++){
                $chi_tiet_dh = new ChiTietDonHang;
                $chi_tiet_dh->donhang_id =$id;
                $chi_tiet_dh->vatdung_id = $vatdung_id_mang[$i];
                $chi_tiet_dh->so_luong = $soluong_mang[$i];
                $chi_tiet_dh->save();

                $vat_dung = VatDung::find($vatdung_id_mang[$i]);
                $tong_gia = $tong_gia+($vat_dung['don_gia']+$vat_dung['phu_phi'])*$soluong_mang[$i];
            }
            $don_hang =  DonHang::find($id);
            $don_hang ->khach_hang = $request ->txt_KH;
            $don_hang ->nguoi_tao_don = Auth::user()->username;
            $don_hang ->tong_gia = $tong_gia;
            $time = strtotime( $request ->date);
            $don_hang ->ngay_giao_hang = date('Y-m-d', $time);
            $don_hang ->trang_thai = 0;
            $don_hang -> save();
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
    public function listDhDaXL(){
        $data = DonHang::where('trang_thai',2)->orderBy('id','DESC')->get()->toArray();
        $action = 'Đã xử lý';
        return view('admin.donhang.list',compact('data','action'));
    }
    public function listDhCXL(){
        $data = DonHang::where('trang_thai',0)->orderBy('id','DESC')->get()->toArray();
        $action = 'Chưa xử lý';
        return view('admin.donhang.list',compact('data','action'));
    }
}
