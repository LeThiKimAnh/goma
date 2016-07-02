<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public function getAdd(){
    	return view('admin.user.add');
    }
    public function postAdd(UserRequest $request){
    	$user = new User;
    	$user->username = $request->txtUser;
    	$user->email 	= $request->txtEmail;
    	$user->password = bcrypt($request->txtPass);
        $user->level = $request->rdoLevel;
    	$user->save();
    	return redirect()->route('listUser')->with(['flash_level'=>'success','flash_message'=>'Success !!Complete Add User']);
    }
    public function listUser(){
    	$data = User::select('id','username','level')->get()->toArray();
        return view('admin.user.list',compact('data'));
    }
    public function deleteUser($id){
    	$user = User::find($id);
        $user->delete($id);
        return redirect()->route('listUser')->with(['flash_level'=>'success','flash_message'=>'Success !!Complete Delete User']);
    }
    public function getEdit($id){
        $data = User::find($id);
        return view('admin.user.edit',compact('data'));
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
            return redirect()->route('listUser')->with(['flash_level'=>'success','flash_message'=>'Success !!Complete Edit User']);
	             
	    }
}
