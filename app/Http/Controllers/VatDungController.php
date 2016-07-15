<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\VatDungRequest;

use App\VatLieu;
use App\VatDung;
use App\ChiTietVatDung;
use App\ChiTietDonHang;
use App\DonHang;
use DB;

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

class VatDungController extends Controller
{
    public function get_themVatDung(){
    	$data = VatLieu::select('id','ten')->get()->toArray();
        $tb = "vật liệu";
        $controller = 'Vật Dụng';
        if(count($data)>0){
            return view('admin.vatdung.add',compact('data'));
        }else{
            return view('admin.blocks.thongbao',compact('tb','controller'));
        }
    	
    }
    public function post_themVatDung(VatDungRequest $request){
        $vatlieu_id_mang_get = $request->vatlieu;
        $soluong_mang_get = $request->soLuong;

        $vatlieu_id_mang = array_slice($vatlieu_id_mang_get, 1,count($vatlieu_id_mang_get)-1);
        $soluong_mang =array_slice($soluong_mang_get, 1,count($soluong_mang_get)-1);

        if(count($vatlieu_id_mang)>0){
            if((check($vatlieu_id_mang,0)==0)&&(!check_slg($soluong_mang))){
                $cout = VatDung::max('id');
            	$vat_dung = new VatDung;
                $vat_dung->ma_vat_dung = "VD".($cout+1);
            	$vat_dung->ten = $request->txt_vd;
                $vat_dung->gia_san_xuat = $request->txt_giaSX;
                $vat_dung->he_so = $request->txt_heSo;
                $vat_dung->gia_san_pham = ($request->txt_heSo)*($request->txt_giaSX);
            	$vat_dung->mo_ta = $request->txt_mo_ta;
            	$vat_dung->save();
            	$vatdung_id = $vat_dung->id;

            	for($i = 0;$i<count($vatlieu_id_mang);$i++){
            		$chi_tiet_vd = new ChiTietVatDung;
            		$chi_tiet_vd->vatdung_id = $vatdung_id;
            		$chi_tiet_vd->vatlieu_id = $vatlieu_id_mang[$i];
            		$chi_tiet_vd->so_luong = $soluong_mang[$i];
            		$chi_tiet_vd->save();
                    $vat_lieu = VatLieu::find($vatlieu_id_mang[$i]);
            	}

                return redirect()->route('vd-getList')->with(['flash_level'=>'success','flash_message_success'=>'Success !! Đã thêm thành công vật liệu']);
            }
            if((check($vatlieu_id_mang,0)==0)&&(check($soluong_mang,'')==1)){
                return redirect()->route('getVatdung')->with(['flash_level'=>'success','flash_message'=>'Cảnh báo !! Bạn chưa điền số lượng vật liệu']);
            }
            if((check($vatlieu_id_mang,0)==1)&&(check($soluong_mang,'')==0)){
                return redirect()->route('getVatdung')->with(['flash_level'=>'success','flash_message'=>'Cảnh báo !! Bạn chưa chọn đầy đủ vật liệu']);
            }
        }
        
        return redirect()->route('getVatdung')->with(['flash_level'=>'success','flash_message'=>'Cảnh báo !! Tối thiểu phải có một vật liệu trong vật dụng']);
    }
    public function listVd(){
    	$data = VatDung::select('id','ten','mo_ta','ma_vat_dung','gia_san_xuat','gia_san_pham','he_so')->orderBy('id','DESC')->get()->toArray();
    	return view('admin.vatdung.list',compact('data'));
    }
    public function deleteVD($id){
        $chi_tiet_dh = ChiTietDonHang::where('vatdung_id',$id);
        if($chi_tiet_dh->count()>0){
            return redirect()->route('vd-getList')->with(['flash_level'=>'success','flash_message'=>'Cảnh báo !! Bạn không thể xóa vật dụng này, có đơn hàng đang chứa nó, phải xóa đơn hàng trước']);
        }else{
            $vat_dung = VatDung::find($id);
            $vat_dung->delete($id);
            return redirect()->route('vd-getList')->with(['flash_level'=>'success','flash_message_success'=>'Success !! Đã xóa thành công vật dụng']);
        }
    }
    public function getEdit($id){
        $data = VatLieu::select('id','ten')->get()->toArray();
        $vat_dung = VatDung::find($id);
        $vat_lieus = DB::table('chi_tiet_vat_dung')->join('vat_lieu','vat_lieu.id','=','chi_tiet_vat_dung.vatlieu_id')->where('chi_tiet_vat_dung.vatdung_id','=',$id)->get();
        return view('admin.vatdung.edit',compact('data','vat_dung','vat_lieus'));
    }
    public function postEdit(Request $request,$id){
        $this->validate($request,
            ['txt_vd'=>'required'],
            ["txt_vd.required"=>"Xin hãy nhập tên vật dung!!"]
            );
        $vatlieu_id_mang_get = $request->vatlieu;
        $soluong_mang_get = $request->soLuong;

        $vatlieu_id_mang = array_slice($vatlieu_id_mang_get, 1,count($vatlieu_id_mang_get)-1);
        $soluong_mang =array_slice($soluong_mang_get, 1,count($soluong_mang_get)-1);
        
        if(count($vatlieu_id_mang)>0){
            if((check($vatlieu_id_mang,0)==0)&&(!check_slg($soluong_mang))){
                $chitiet = ChiTietVatDung::where('vatdung_id','=',$id);
                $chitiet->delete();

                for($i = 0;$i<count($vatlieu_id_mang);$i++){
                    $chi_tiet_vd = new ChiTietVatDung;
                    $chi_tiet_vd->vatdung_id = $id;
                    $chi_tiet_vd->vatlieu_id = $vatlieu_id_mang[$i];
                    $chi_tiet_vd->so_luong = $soluong_mang[$i];
                    $chi_tiet_vd->save();

                    $vat_lieu = VatLieu::find($vatlieu_id_mang[$i]);

                }
                $vat_dung =  VatDung::find($id);
                $vat_dung->ten = $request->txt_vd;
                $vat_dung->mo_ta = $request->txt_mo_ta;
                $vat_dung->gia_san_xuat = $request->txt_giaSX;
                $vat_dung->he_so = $request->txt_heSo;
                $vat_dung->gia_san_pham = ($request->txt_heSo)*($request->txt_giaSX);
                $vat_dung->save();

                return redirect()->route('vd-getList')->with(['flash_level'=>'success','flash_message_success'=>'Success !! Đã sửa thành công vật dụng']);
            }
            if((check($vatlieu_id_mang,0)==0)&&(check($soluong_mang,'')==1)){
                return redirect()->route('getEditVD',$id)->with(['flash_level'=>'success','flash_message'=>'Cảnh báo !! Bạn chưa điền số lượng vật liệu']);
            }
            if((check($vatlieu_id_mang,0)==1)&&(check($soluong_mang,'')==0)){
                return redirect()->route('getEditVD',$id)->with(['flash_level'=>'success','flash_message'=>'Cảnh báo !! Bạn chưa chọn đầy đủ vật liệu']);
            }
        }
        return redirect()->route('getEditVD',$id)->with(['flash_level'=>'success','flash_message'=>'Cảnh báo !! Tối thiểu phải có một vật liệu trong vật dụng']);

    }
    public function chitiet($id){
        $vat_dung = VatDung::find($id);
        $chi_tiet_vd = ChiTietVatDung::where('vatdung_id',$id)->get()->toArray();
        return view('admin.vatdung.chitiet',compact('vat_dung','chi_tiet_vd'));
    }

    public function searchVD(Request $request){
        $maVD = $request->txt_maVD;
        $tenVD = $request->txt_VD;
        $gia_SX = $request->txt_giaSX;
        $gia_SP = $request->txt_giaSP;
        $he_so = $request->txt_HS;
        $data = VatDung::select('id','ten','mo_ta','ma_vat_dung','gia_san_xuat','gia_san_pham','he_so');

        $sql_data = "";

        if(!ctype_space($maVD)&&!empty($maVD)){
           $sql[] = " ma_vat_dung = '".$maVD."'";
        }
        if(!ctype_space($tenVD)&&!empty($tenVD)){
            $sql[] = " ten= '".$tenVD."'";
        }
        if(!ctype_space($gia_SX)&&!empty($gia_SX)){
            $sql[] = " gia_san_xuat=".$gia_SX."";
        }
        if(!ctype_space($gia_SP)&&!empty($gia_SP)){
            $sql[] = " gia_san_pham =".$gia_SP."";
        }
        if(!ctype_space($he_so)&&!empty($he_so)){
            $sql[] = " he_so=".$he_so;
        }
        
        for($i = 0; $i<count($sql);$i++){
            if($i==count($sql)-1){
                $sql_data = $sql_data.$sql[$i];
            }else{
                 $sql_data = $sql_data.$sql[$i]." and";
             }
        }

        $data = VatDung::whereRaw($sql_data)->get();
        return view('admin.vatdung.list',compact('data'));

    }

}
