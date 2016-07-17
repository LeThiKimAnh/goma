<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\GoThuaRequest;
use App\GoThua;


class GoThuaController extends Controller
{
    public function getAdd(){
    	return view('admin.gothua.add');
    }
    public function postAdd(GoThuaRequest $request){
    	$go_thua = new GoThua();
    	$go_thua->ten = $request->txt_ten;
    	$go_thua->rong =$request->txt_chieu_rong;
    	$go_thua->dai = $request->txt_chieu_dai;
    	$go_thua->cao = $request->txt_chieu_cao;
        $go_thua->chat_lieu = $request->sl_chat_lieu;
        $go_thua->yeu_cau = $request->sl_yeu_cau;
    	$go_thua->save();
    	return redirect()->route('khogoList')->with(['flash_level'=>'success','flash_message_success'=>'Nhập gỗ vào thành công']);
    }
     public function listGo(){
        $per_page = 2;
        $tenVL = "";
        $rong ="";
        $dai = "";
        $chat_lieu = -1;
        $loai = -1;
    	$data = GoThua::orderBy('id', 'DESC')->paginate($per_page);
    	return view('admin.gothua.list',compact('data','tenVL','rong','dai','chat_lieu','loai'));
    }
    public function delGo($id){
    	$gothua = GoThua::find($id);
    	if($gothua!=null){
    		$gothua->delete();
    		return redirect()->route('khogoList')->with(['flash_level'=>'success','flash_message_success'=>'Xóa thành công']);
    	}else{
    		return view('errors.404');
    	}
    }
    public function getEdit($id){
    	$go_thua = GoThua::find($id);
        if($go_thua!= null){
            return view('admin.vatlieu.edit',compact('go_thua'));
        }else{
            return view('errors.404');
        }
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
        $gothua =  GoThua::find($id);
    	$gothua->ten = $request->txt_ten;
        $gothua->rong =$request->txt_chieu_rong;
        $gothua->dai = $request->txt_chieu_dai;
        $gothua->cao = $request->txt_chieu_cao;
        $gothua->chat_lieu = $request->sl_chat_lieu;
        $gothua->yeu_cau = $request->sl_yeu_cau;
        $gothua->save();
    	return redirect()->route('khogoList')->with(['flash_level'=>'success','flash_message_success'=>'Sửa thành công']);
    }
    public function searchGo(Request $request){
    	$per_page = 2;
        $tenVL = $request->txt_ten;
        $rong = $request->txt_R;
        $dai = $request->txt_D;
        $chat_lieu = $request->txt_CL;
        $loai = $request->txt_YC;

        $sql_data = "";
        $sql = array();

        if(!ctype_space($tenVL)&&!empty($tenVL)){
            $sql[] = " ten= '".$tenVL."'";
        }
        if(!ctype_space($rong)&&!empty($rong)){
            $sql[] = " rong=".$rong."";
        }
        if(!ctype_space($dai)&&!empty($dai)){
            $sql[] = " dai =".$dai."";
        }
        if (!ctype_space($chat_lieu)&&!empty($chat_lieu)&&$chat_lieu>0) {
            $sql[] = " chat_lieu=" . $chat_lieu . "";
        }
        if (!ctype_space($loai)&&!empty($loai)&&$loai>=0) {
            $sql[] = " yeu_cau=" . $loai . "";
        }
        
       if (count($sql)) {
            $sql_data = implode(" and ", $sql);
            $data = GoThua::whereRaw($sql_data)->orderBy('id', 'DESC')->paginate($per_page);
        } else {
            $data = GoThua::orderBy('id', 'DESC')->paginate($per_page);
        }

        $data->setPath($request->fullUrl());
        return view('admin.gothua.list',compact('data','maVL','tenVL','rong','dai','chat_lieu','loai'));
    }
}
