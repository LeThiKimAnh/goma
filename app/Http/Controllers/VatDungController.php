<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\VatDungRequest;

use App\VatLieu;
use App\VatDung;
use App\ChiTietVatDung;

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

class VatDungController extends Controller
{
    public function get_themVatDung(){
    	$data = VatLieu::select('id','ten')->get()->toArray();
        $tb = "vật liệu";
        $controller = 'Vật Dụng';
        if(length($data)>0){
            return view('admin.vatdung.add',compact('data'));
        }else{
            return view('admin.blocks.thongbao',compact('tb','controller'));
        }
    	
    }
    public function post_themVatDung(VatDungRequest $request){
        $vatlieu_id_mang = $request->vatlieu;
        $soluong_mang = $request->soLuong;

        if((check($vatlieu_id_mang,0)==0)&&(check($soluong_mang,'')==0)){
            $cout = VatDung::max('id');
        	$vat_dung = new VatDung;
            $vat_dung->ma_vat_dung = "VD".($cout+1);
        	$vat_dung->ten = $request->txt_vd;
        	$vat_dung->mo_ta = $request->txt_mo_ta;
        	$vat_dung->save();
        	$vatdung_id = $vat_dung->id;

        	for($i = 0;$i<length($vatlieu_id_mang);$i++){
        		$chi_tiet_vd = new ChiTietVatDung;
        		$chi_tiet_vd->vatdung_id = $vatdung_id;
        		$chi_tiet_vd->vatlieu_id = $vatlieu_id_mang[$i];
        		$chi_tiet_vd->so_luong = $soluong_mang[$i];
        		$chi_tiet_vd->save();
        	}
            return redirect()->route('vd-getList')->with(['flash_level'=>'success','flash_message'=>'Success !! Đã thêm thành công vật liệu']);
        }
        if((check($vatlieu_id_mang,0)==0)&&(check($soluong_mang,'')==1)){
            return redirect()->route('getVatdung')->with(['flash_level'=>'success','flash_message'=>'Cảnh báo !! Bạn chưa điền số lượng vật liệu']);
        }
        if((check($vatlieu_id_mang,0)==1)&&(check($soluong_mang,'')==0)){
            return redirect()->route('getVatdung')->with(['flash_level'=>'success','flash_message'=>'Cảnh báo !! Bạn chưa chọn đầy đủ vật liệu']);
        }
        
        return redirect()->route('getVatdung')->with(['flash_level'=>'success','flash_message'=>'Cảnh báo !! Tối thiểu phải có một vật liệu trong vật dụng']);
    }
    public function list(){
    	$data = VatDung::select('id','ten','mo_ta','ma_vat_dung')->get()->toArray();
    	return view('admin.vatdung.list',compact('data'));
    }
    public function delete($id){
        $vat_dung = VatDung::find($id);
        $vat_dung->delete($id);
        return redirect()->route('vd-getList')->with(['flash_level'=>'success','flash_message'=>'Success !! Đã xóa thành công vật dụng']);
    }
    public function getEdit($id){
        $data = VatLieu::select('id','ten')->get()->toArray();
        $vat_dung = VatDung::find($id);
        return view('admin.vatdung.edit',compact('data','vat_dung'));
    }
    public function postEdit(Request $request,$id){
        $this->validate($request,
            ['txt_vd'=>'required'],
            ["txt_vd.required"=>"Xin hãy nhập tên vật dung!!"]
            );
        $vatlieu_id_mang = $request->vatlieu;
        $soluong_mang = $request->soLuong;
        if((check($vatlieu_id_mang,0)==0)&&(check($soluong_mang,'')==0)){
            $vat_dung =  VatDung::find($id);
            $vat_dung->ten = $request->txt_vd;
            $vat_dung->mo_ta = $request->txt_mo_ta;
            $vat_dung->save();

            $chitiet = ChiTietVatDung::where('vatdung_id','=',$id);
            $chitiet->delete();

            for($i = 0;$i<length($vatlieu_id_mang);$i++){
                $chi_tiet_vd = new ChiTietVatDung;
                $chi_tiet_vd->vatdung_id = $id;
                $chi_tiet_vd->vatlieu_id = $vatlieu_id_mang[$i];
                $chi_tiet_vd->so_luong = $soluong_mang[$i];
                $chi_tiet_vd->save();
            }
            return redirect()->route('vd-getList')->with(['flash_level'=>'success','flash_message'=>'Success !! Đã sửa thành công vật dụng']);
       }
       if((check($vatlieu_id_mang,0)==0)&&(check($soluong_mang,'')==1)){
            return redirect()->route('getEditVD',$id)->with(['flash_level'=>'success','flash_message'=>'Cảnh báo !! Bạn chưa điền số lượng vật liệu']);
        }
        if((check($vatlieu_id_mang,0)==1)&&(check($soluong_mang,'')==0)){
            return redirect()->route('getEditVD',$id)->with(['flash_level'=>'success','flash_message'=>'Cảnh báo !! Bạn chưa chọn đầy đủ vật liệu']);
        }
        
        return redirect()->route('getEditVD',$id)->with(['flash_level'=>'success','flash_message'=>'Cảnh báo !! Tối thiểu phải có một vật liệu trong vật dụng']);

    }
    public function chitiet($id){
        $vat_dung = VatDung::find($id);
        $chi_tiet_vd = ChiTietVatDung::where('vatdung_id',$id)->get()->toArray();
        return view('admin.vatdung.chitiet',compact('vat_dung','chi_tiet_vd'));
    }

}
