<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\VatLieuRequest;
use App\VatLieu;
use App\ChiTietVatDung;
class VatLieuController extends Controller
{
    public function get_themVatLieu(){
    	return view('admin.vatlieu.add');
    }
    public function post_themVatLieu(VatLieuRequest $request){
        $cout = VatLieu::max('id');
    	$vat_lieu = new VatLieu;
    	$vat_lieu->ten = $request->txt_ten;
        $vat_lieu->ten_ma = "VL".($cout+1);
    	$vat_lieu->rong =$request->txt_chieu_rong;
    	$vat_lieu->dai = $request->txt_chieu_dai;
    	$vat_lieu->cao = $request->txt_chieu_cao;
        $vat_lieu->don_gia = $request->txt_don_gia;
        $vat_lieu->chat_lieu = $request->sl_chat_lieu;
        $vat_lieu->yeu_cau = $request->sl_yeu_cau;
    	$vat_lieu->mo_ta = $request->txt_mo_ta;
    	$vat_lieu->save();
    	return redirect()->route('list')->with(['flash_level'=>'success','flash_message_success'=>'Thêm vật liệu thành công']);
    }
    public function listVl(){
    	$data = VatLieu::select('id','ten','ten_ma','rong','dai','cao','mo_ta','chat_lieu','don_gia','yeu_cau')->orderBy('id','DESC')->get()->toArray();
    	return view('admin.vatlieu.list',compact('data'));
    }
    public function deleteVL($id){
        $chi_tiet_vd = ChiTietVatDung::where('vatlieu_id',$id);
        if($chi_tiet_vd->count()>0){
            return redirect()->route('list')->with(['flash_level'=>'success','flash_message'=>'Bạn không thể xóa vật liệu này vì có vật dụng đang dùng nó, bạn phải xóa vật dụng trước']);
        }else{
            $vat_lieu = VatLieu::find($id);
            $vat_lieu->delete();
            return redirect()->route('list')->with(['flash_level'=>'success','flash_message_success'=>'Xóa vật liệu thành công']);
        }
    }
    public function getEdit($id){
    	$vat_lieu = VatLieu::find($id);
    	return view('admin.vatlieu.edit',compact('vat_lieu'));
    }
    public function postEdit(Request $request,$id){
    	$this->validate($request,
            ['txt_ten'=>'required'],
            ["txt_ten.required"=>"Xin hãy nhập tên vật liệu!!"]
            );
    	$this->validate($request,
            ['txt_chieu_rong'=>'required'],
            ["txt_chieu_rong.required"=>"Xin hãy nhập chiều rộng!!"]
            );
    	$this->validate($request,
            ['txt_chieu_dai'=>'required'],
            ["txt_chieu_dai.required"=>"Xin hãy nhập chiều dài!!"]
            );
    	$this->validate($request,
            ['txt_chieu_cao'=>'required'],
            ["txt_chieu_cao.required"=>"Xin hãy nhập chiều cao!!"]
            );
    	$this->validate($request,
            ['txt_chieu_rong'=>'numeric'],
            ["txt_chieu_rong.numeric"=>"Xin hãy nhập chiều rộng!!"]
            );
    	$this->validate($request,
            ['txt_chieu_dai'=>'numeric'],
            ["txt_chieu_dai.numeric"=>"Xin hãy nhập chiều dài!!"]
            );
    	$this->validate($request,
            ['txt_chieu_cao'=>'numeric'],
            ["txt_chieu_cao.numeric"=>"Xin hãy nhập chiều cao!!"]
            );
        $this->validate($request,
            ['txt_don_gia'=>'required'],
            ["txt_don_gia.required"=>"Xin hãy nhập mã vật liệu!!"]
            );
         $this->validate($request,
            ['sl_yeu_cau'=>'required'],
            ["sl_yeu_cau.required"=>"Xin hãy chọn yêu cầu!!"]
            );
         $this->validate($request,
            ['sl_chat_lieu'=>'required'],
            ["sl_chat_lieu.required"=>"Xin hãy chọn chất liệu!!"]
            );
    	$vat_lieu =  VatLieu::find($id);
    	$vat_lieu->ten = $request->txt_ten;
        $vat_lieu->rong =$request->txt_chieu_rong;
        $vat_lieu->dai = $request->txt_chieu_dai;
        $vat_lieu->cao = $request->txt_chieu_cao;
        $vat_lieu->don_gia = $request->txt_don_gia;
        $vat_lieu->chat_lieu = $request->sl_chat_lieu;
        $vat_lieu->yeu_cau = $request->sl_yeu_cau;
        $vat_lieu->mo_ta = $request->txt_mo_ta;
        $vat_lieu->save();
    	return redirect()->route('list')->with(['flash_level'=>'success','flash_message_success'=>'Sửa vật liệu thành công']);
    }
}
