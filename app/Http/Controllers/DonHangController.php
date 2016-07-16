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
function check_slg($array){
    for($i =0;$i<count($array);$i++){
        if($array[$i]<=0){
            return true;
        }
    }
    return false;
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
        print_r(count($vatdung_id_mang));
        if(count($vatdung_id_mang)>0){
            if(count(array_unique($vatdung_id_mang))<count($vatdung_id_mang)){
                return redirect()->route('getDonhang')->with(['flash_level'=>'success','flash_message'=>'Cảnh báo !! không thể chọn hai lần 1 vật dụng']);
            }else{
                if((check($vatdung_id_mang,0)==0)&&(!check_slg($soluong_mang))){
                $cout = DonHang::max('id');
                $don_hang = new DonHang;
                $don_hang ->khach_hang = $request ->txt_KH;
                $don_hang->ma_don_hang = "DH".($cout+1);
                $don_hang ->nguoi_tao_don = Auth::user()->username;
                $time = strtotime( $request ->date);
                $don_hang ->ngay_giao_hang =  date('Y-m-d', $time);
                $don_hang ->trang_thai = 0;
                $don_hang ->mo_ta = $request->txtDescription;
                $don_hang -> save();
                $donhang_id = $don_hang->id;

                $tong_gia = 0;

                for($i = 0;$i<count($vatdung_id_mang);$i++){
                    $vat_dung = VatDung::find($vatdung_id_mang[$i]);
                    $chi_tiet_dh = new ChiTietDonHang;
                    $chi_tiet_dh->donhang_id = $donhang_id;
                    $chi_tiet_dh->vatdung_id = $vatdung_id_mang[$i];
                    $chi_tiet_dh->don_gia = $vat_dung['gia_san_pham'];
                    $chi_tiet_dh->so_luong = $soluong_mang[$i];
                    $chi_tiet_dh->save();

                    $vat_dung = VatDung::find($vatdung_id_mang[$i]);
                    $tong_gia = $tong_gia+$vat_dung['gia_san_pham']*$soluong_mang[$i];
                }
                $don_hang = DonHang::find($donhang_id);
                $don_hang->tong_gia = $tong_gia;
                $don_hang->save();

                return redirect()->route('listDh')->with(['flash_level'=>'success','flash_message2'=>'Success !! Đã thêm thành công đơn hàng']);
                }
                if((check($vatdung_id_mang,0)==0)&&(check($soluong_mang,'')==1)){
                    return redirect()->route('getDonhang')->with(['flash_level'=>'success','flash_message'=>'Cảnh báo !! Bạn chưa điền số lượng vật dụng']);
                }
                if((check($vatdung_id_mang,0)==1)&&(check($soluong_mang,'')==0)){
                    return redirect()->route('getDonhang')->with(['flash_level'=>'success','flash_message'=>'Cảnh báo !! Bạn chưa chọn đầy đủ vật dung']);
                } 
            }
        }

        return redirect()->route('getDonhang')->with(['flash_level'=>'success','flash_message'=>'Cảnh báo !! Tối thiểu phải có một vật dụng trong đơn hàng']);
    }
    public function listDh(){
        $action = 'List';
        $maDH = "";
        $tenKH = "";
        $nguoi_TD = "";
        $trang_thai = "";
        $d1 = "";
        $d2 = "";
        $data = DonHang::orderBy('id','DESC')->paginate(10);
        return view('admin.donhang.list',compact('data','action','maDH','tenKH','d1','d2','nguoi_TD','trang_thai'));
        // return view('admin.donhang.list',compact('data','action'));
    }
    public function deleteDH($id){
        $don_hang = DonHang::find($id);
        if($don_hang['trang_thai']==0){
             $don_hang->delete();
            return redirect()->route('listDh')->with(['flash_level'=>'success','flash_message2'=>'Success !! Đã xóa thành công đơn hàng']);
        }else{
            return redirect()->route('listDh')->with(['flash_level'=>'success','flash_message1'=>'Cảnh báo!! Đơn hàng này đã xử lý hoặc đang đợi xử lý, bạn không thể xóa được']);
        }
       
    }
    public function getEdit($id){
        $don_hang = DonHang::find($id);
        if($don_hang['trang_thai']==0){
            $data = VatDung::select('id','ten')->get()->toArray();
            $vatdungs = DB::table('chi_tiet_don_hang')->join('vat_dung','vat_dung.id','=','chi_tiet_don_hang.vatdung_id')->where('chi_tiet_don_hang.donhang_id','=',$id)->get();
            return view('admin.donhang.edit',compact('data','don_hang','vatdungs'));
        }else{
            return redirect()->route('listDh')->with(['flash_level'=>'success','flash_message1'=>'Cảnh báo !! Đơn hàng này đã hoặc đang chờ xử lý, không được sửa ^_^']);
        }
    }
    public function postEdit(Request $request,$id){
        $this->validate($request,
            ['txt_KH'=>'required'],
            ["txt_KH.required"=>"Xin hãy nhập tên khách hàng!!"]
            );
        $vatdung_id_mang_get = $request->vatdung;
        $soluong_mang_get = $request->soLuong;
        $vatdung_id_mang = array_slice($vatdung_id_mang_get, 1,count($vatdung_id_mang_get)-1);
        $soluong_mang =array_slice($soluong_mang_get, 1,count($soluong_mang_get)-1);

        if(count($vatdung_id_mang)>0){
            if((check($vatdung_id_mang,0)==0)&&(!check_slg($soluong_mang))){

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
                    $tong_gia = $tong_gia+$vat_dung['gia_san_pham']*$soluong_mang[$i];
                }
                $don_hang =  DonHang::find($id);
                $don_hang ->khach_hang = $request ->txt_KH;
                $don_hang ->nguoi_tao_don = Auth::user()->username;
                $don_hang ->tong_gia = $tong_gia;
                $time = strtotime( $request ->date);
                $don_hang ->ngay_giao_hang = date('Y-m-d', $time);
                $don_hang ->trang_thai = 0;
                $don_hang ->mo_ta = $request->txtDescription;
                $don_hang -> save();
                return redirect()->route('listDh')->with(['flash_level'=>'success','flash_message2'=>'Success !! Đã sửa thành công đơn hàng']);
            }
            if((check($vatdung_id_mang,0)==0)&&(check($soluong_mang,'')==1)){
                return redirect()->route('getEditDH',$id)->with(['flash_level'=>'success','flash_message'=>'Cảnh báo !! Bạn chưa điền số lượng vật dụng']);
            }
            if((check($vatdung_id_mang,0)==1)&&(check($soluong_mang,'')==0)){
                return redirect()->route('getEditDH',$id)->with(['flash_level'=>'success','flash_message'=>'Cảnh báo !! Bạn chưa chọn đầy đủ vật dụng']);
            }
        }
        
        return redirect()->route('getEditDH',$id)->with(['flash_level'=>'success','flash_message'=>'Cảnh báo !! Tối thiểu phải có một vật dụng trong đơn hàng']);
    }
    public function chitiet($id){
        $don_hang = DonHang::find($id);
        $check_tt = 0;
        $vatdungs = DB::table('chi_tiet_don_hang')->join('vat_dung','vat_dung.id','=','chi_tiet_don_hang.vatdung_id')->where('chi_tiet_don_hang.donhang_id','=',$id)->get();
        return view('admin.donhang.chitiet',compact('don_hang','id','vatdungs','check_tt'));
    }
    public function chitiet_daXL($id){
        $don_hang = DonHang::find($id);
        $check_tt = 1;
        $chi_tiet_dh = ChiTietDonHang::where('donhang_id','=',$id)->get()->toArray();
        return view('admin.donhang.chitiet',compact('don_hang','chi_tiet_dh','id','check_tt'));
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

    public function searchDH(Request $request){
        $page = $request->page;
        $per_page = 10;
        $action = 'List';
        $maDH = $request ->txt_maDH;
        $tenKH = $request ->txt_KH;
        $nguoi_TD = $request->txt_NL;
        $trang_thai = $request->txt_TT;
        $d1 = $request ->start_date;
        $d2 = $request ->end_date;
        $time1 = strtotime( $request ->start_date);
        $time2 =   strtotime( $request ->end_date);
        $start_date = date('Y-m-d', $time1);
        $end_date = date('Y-m-d', $time2);

         $sql_data = "";
        if(!ctype_space($maDH)&&!empty($maDH)){
            $sql[] = " ma_don_hang ='".$maDH."'";
        }
        if(!ctype_space($tenKH)&&!empty($tenKH)){
            $sql[] =" khach_hang='".$tenKH."'";
        }
        if(!ctype_space($nguoi_TD)&&!empty($nguoi_TD)){
            $sql[] =" nguoi_tao_don='".$nguoi_TD."'";
        }
        if($trang_thai!=""){
            $sql[] = " trang_thai=".$trang_thai."";
        }
        if(!ctype_space($time1)&&!empty($time1)&&!ctype_space($time2)&&!empty($time2)){
            $sql[] = " ngay_giao_hang >= ".$start_date." and ngay_giao_hang <= ".$end_date."";

        }
        for($i = 0; $i<count($sql);$i++){
            if($i==count($sql)-1){
                $sql_data = $sql_data.$sql[$i];
            }else{
                 $sql_data = $sql_data.$sql[$i]." and";
             }
        }
        print_r($sql);


        $data = DonHang::whereRaw($sql_data)->orderBy('id','DESC')->paginate(2);
        print_r($data);
        return view('admin.donhang.list',compact('data','action','maDH','tenKH','d1','d2','nguoi_TD','trang_thai'));
        
        }
    
}
