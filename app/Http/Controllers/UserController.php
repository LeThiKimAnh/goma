<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Http\Requests\UserRequest;
use Auth;

class UserController extends Controller
{
    public function getAdd(){
        $user = Auth::user()->level;
        if($user==1){
            return view('admin.user.add');
        }else{
            return redirect()->route('listUser')->with(['flash_level'=>'success','flash_message'=>'Bạn không đủ quyền để thực hiện tác vụ này']);
        }	
    }
    public function postAdd(UserRequest $request){
    	$user = new User;
    	$user->username = $request->txtUser;
    	$user->email 	= $request->txtEmail;
    	$user->password = bcrypt($request->txtPass);
        $user->level = $request->rdoLevel;
    	$user->save();
    	return redirect()->route('listUser')->with(['flash_level'=>'success','flash_message_success'=>'Success !!Complete Add User']);
    }
    public function listUser(){
    	$data = User::select('id','username','level')->where('level','=',2)->get()->toArray();
        return view('admin.user.list',compact('data'));
    }
    public function deleteUser($id){
        $user = Auth::user()->level;
        if($user == 1){
            $user = User::find($id);
            $user->delete($id);
            return redirect()->route('listUser')->with(['flash_level'=>'success','flash_message_success'=>'Success !!Complete Delete User']);
        }else{
            return redirect()->route('listUser')->with(['flash_level'=>'success','flash_message'=>'Bạn không đủ quyền để thực hiện tác vụ này']);
        }
    	
    }
    public function getEdit($id){
        $user = Auth::user()->level;
        if($user ==1){
            $data = User::find($id);
            return view('admin.user.edit',compact('data'));
        }else{
            return redirect()->route('listUser')->with(['flash_level'=>'success','flash_message'=>'Bạn không đủ quyền để thực hiện tác vụ này']);
        }
        
    }
    public function postEdit(Request $request,$id){
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
	             
	    }
    public function getRepass(){
        return view('admin.user.repass');
    }
    public function postRepass(Request $request){
        if(bcrypt($request->txtPass)==Auth::user()->password){
            $user = User::find(Auth::user()->id);
            $user->password = bcrypt($request->txtPass);
        }
    }
}
