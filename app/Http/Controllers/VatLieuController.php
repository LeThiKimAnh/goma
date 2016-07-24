<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\VatLieuRequest;
use App\VatLieu;
use App\ChiTietVatDung;
use Auth;

class VatLieuController extends Controller
{
    public function get_themVatLieu(){
        if(Auth::user()->level==1||Auth::user()->level==2){
        	return view('admin.vatlieu.add');
        }else{
            return view('errors.404');
        }
    }
    public function post_themVatLieu(VatLieuRequest $request){
        if(Auth::user()->level==1||Auth::user()->level==2){
            $cout = VatLieu::max('id');
        	$vat_lieu = new VatLieu;
        	$vat_lieu->ten = $request->txt_ten;
            $vat_lieu->ten_ma = "VL".($cout+1);
        	$vat_lieu->rong =$request->txt_chieu_rong;
        	$vat_lieu->dai = $request->txt_chieu_dai;
        	$vat_lieu->cao = $request->txt_chieu_cao;
            $vat_lieu->chat_lieu = $request->sl_chat_lieu;
            $vat_lieu->yeu_cau = $request->sl_yeu_cau;
        	$vat_lieu->mo_ta = $request->txt_mo_ta;
        	$vat_lieu->save();
        	return redirect()->route('list')->with(['flash_level'=>'success','flash_message_success'=>'Thêm vật liệu thành công']);
        }else{
             return view('errors.500');
        }
    }
    public function listVl(){
        if(Auth::user()->level==1||Auth::user()->level==2){
            $per_page = 10;
            $maVL = "";
            $tenVL = "";
            $rong ="";
            $dai = "";
            $chat_lieu = -1;
            $loai = -1;
        	$data = VatLieu::orderBy('id', 'DESC')->paginate($per_page);
        	return view('admin.vatlieu.list',compact('data','maVL','tenVL','rong','dai','chat_lieu','loai'));
        }else{
            return view('errors.404');
        }
    }
    public function deleteVL($id){
        if(Auth::user()->level==1||Auth::user()->level==2){
            $chi_tiet_vd = ChiTietVatDung::where('vatlieu_id',$id);
            if($chi_tiet_vd->count()>0){
                return redirect()->route('list')->with(['flash_level'=>'success','flash_message'=>'Bạn không thể xóa vật liệu này vì có vật dụng đang dùng nó, bạn phải xóa vật dụng trước']);
            }else{
                $vat_lieu = VatLieu::find($id);
                $vat_lieu->delete();
                return redirect()->route('list')->with(['flash_level'=>'success','flash_message_success'=>'Xóa vật liệu thành công']);
            }
        }else{
            return view('errors.500');
        }
    }
    public function getEdit($id){
        if(Auth::user()->level==1||Auth::user()->level==2){
        	$vat_lieu = VatLieu::find($id);
            if($vat_lieu!= null){
                return view('admin.vatlieu.edit',compact('vat_lieu'));
            }else{
                return view('errors.404');
            }
        }else{
            return view('errors.404');
        }
    	
    }
    public function postEdit(Request $request,$id){
        if(Auth::user()->level==1||Auth::user()->level==2){
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
                ["txt_chieu_rong.numeric"=>"Chiều rộng phải là số!!"]
                );
        	$this->validate($request,
                ['txt_chieu_dai'=>'numeric'],
                ["txt_chieu_dai.numeric"=>"chiều dài phải là số!!"]
                );
        	$this->validate($request,
                ['txt_chieu_cao'=>'numeric'],
                ["txt_chieu_cao.numeric"=>"Xin hãy nhập chiều cao!!"]
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
            $vat_lieu->chat_lieu = $request->sl_chat_lieu;
            $vat_lieu->yeu_cau = $request->sl_yeu_cau;
            $vat_lieu->mo_ta = $request->txt_mo_ta;
            $vat_lieu->save();
        	return redirect()->route('list')->with(['flash_level'=>'success','flash_message_success'=>'Sửa vật liệu thành công']);
        }else{
            return view('errors.500');
        }
    }
    public function searchVL(Request $request){
        if(Auth::user()->level==1||Auth::user()->level==2){
            $per_page = 10;
            $maVL = $request->txt_maVL;
            $tenVL = $request->txt_VL;
            $rong = $request->txt_R;
            $dai = $request->txt_D;
            $chat_lieu = $request->txt_CL;
            $loai = $request->txt_YC;

            $sql_data = "";
            $sql = array();

            if(!ctype_space($maVL)&&!empty($maVL)){
               $sql[] = " ten_ma = '".$maVL."'";
            }
            if(!ctype_space($tenVL)&&!empty($tenVL)){
                $sql[] = " ten= '".$tenVL."'";
            }
            if(!ctype_space($rong)&&!empty($rong)){
                $sql[] = " rong=".$rong."";
            }
            if(!ctype_space($dai)&&!empty($dai)){
                $sql[] = " dai =".$dai."";
            }
            if (!ctype_space($chat_lieu)&&!empty($chat_lieu)) {
                $sql[] = " chat_lieu=" . $chat_lieu . "";
            }
            if (!ctype_space($loai)&&!empty($loai)&&$loai>0) {
                $sql[] = " yeu_cau=" . $loai . "";
            }
            
           if (count($sql)) {
                $sql_data = implode(" and ", $sql);
                $data = VatLieu::whereRaw($sql_data)->orderBy('id', 'DESC')->paginate($per_page);
            } else {
                $data = VatLieu::orderBy('id', 'DESC')->paginate($per_page);
            }

            $data->setPath($request->fullUrl());
            return view('admin.vatlieu.list',compact('data','maVL','tenVL','rong','dai','chat_lieu','loai'));
        }else{
            return view('errors.404');
        }
    }
}
