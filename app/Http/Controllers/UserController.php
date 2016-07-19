<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Http\Requests\UserRequest;
use Auth;
use Hash;

class UserController extends Controller
{
    public function getAdd(){
        if(Auth::user()->level==1){
            $user = Auth::user()->level;
            if($user==1){
                return view('admin.user.add');
            }else{
                return redirect()->route('listUser')->with(['flash_level'=>'success','flash_message'=>'Bạn không đủ quyền để thực hiện tác vụ này']);
            }
        }else{
            return view('errors.404');
        }	
    }
    public function postAdd(UserRequest $request){
        if(Auth::user()->level==1){
        	$user = new User;
        	$user->username = $request->txtUser;
        	$user->email 	= $request->txtEmail;
        	$user->password = bcrypt($request->txtPass);
            $user->level = $request->rdoLevel;
        	$user->save();
        	return redirect()->route('listUser')->with(['flash_level'=>'success','flash_message_success'=>'Success !!Complete Add User']);
        }else{
            return view('errors.500');
        }
    }
    public function listUser(){
    	$data = User::select('id','username','level')->get()->toArray();
        return view('admin.user.list',compact('data'));
    }
    public function deleteUser($id){
        if(Auth::user()->level==1){
            $user = Auth::user()->level;
            if($user == 1){
                $user = User::find($id);
                $user->delete($id);
                return redirect()->route('listUser')->with(['flash_level'=>'success','flash_message_success'=>'Success !!Complete Delete User']);
            }else{
                return redirect()->route('listUser')->with(['flash_level'=>'success','flash_message'=>'Bạn không đủ quyền để thực hiện tác vụ này']);
            }
        }else{
            return view('errors.500');
        }
    	
    }
    public function getEdit($id){
        if(Auth::user()->level==1){
            $user = Auth::user()->level;
            if($user ==1){
                $data = User::find($id);
                return view('admin.user.edit',compact('data'));
            }else{
                return redirect()->route('listUser')->with(['flash_level'=>'success','flash_message'=>'Bạn không đủ quyền để thực hiện tác vụ này']);
            }
        }else{
            return view('errors.404');
        }
    }

    public function postEdit(Request $request,$id){
        if(Auth::user()->level==1){
    	    $this->validate($request,
                ["txtUser"=>"required"],
                ["txtUser.required"=>"Please Enter User Name !!"]
                );
                $user = User::find($id);
                $user->username = $request->txtUser;
                $user->email    = $request->txtEmail;
                $user->password = bcrypt($request->txtPass);
                $user->level = $request->rdoLevel;
                $user->save();
                return redirect()->route('listUser')->with(['flash_level'=>'success','flash_message_success'=>'Success !!Complete Edit User']);     
        }else{
            return view('errors.505');
        }     
    }

    public function getRepass(){
        return view('admin.user.repass');
    }
    public function postRepass(Request $request){
        $this->validate($request,
            ["old_Pass"=>"required"],
            ["old_Pass.required"=>"Bạn phải nhập mật khẩu cũ!!"]
            );
        $this->validate($request,
            ["new_Pass"=>"required"],
            ["new_Pass.required"=>"Bạn phải nhập mật khẩu mới!!"]
            );
        $this->validate($request,
            ["txtRePass"=>"required"],
            ["txtRePass.required"=>"Bạn phải nhập lại mật khẩu mới!!"],
            ["txtRePass.same:new_Pass"=>"Mật khẩu nhập lại chưa khớp!!"]
            );
        $this->validate($request,
            ["txtRePass"=>"same:new_Pass"],
            ["txtRePass.same"=>"Mật khẩu nhập lại chưa khớp!!"]
            );
        $id = Auth::user()->id;
        $user = User::find($id);
        $oldpass = $request->old_Pass;
        if(Hash::check($oldpass,$user->password)){
            $user->password = bcrypt($request->new_Pass);
            $user->save();
            Auth::logout();
            return redirect()->route('getLogin');
        }else{
             return redirect()->route('getRepass')->with(['flash_level'=>'success','flash_message'=>'Bạn nhập mật khẩu sai, vui lòng nhập lại']);
        }
    }
}
