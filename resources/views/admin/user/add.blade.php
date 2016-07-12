@extends('admin.master')
@section('controller','User')
@section('action','Add')
@section('content')
<form action="" method="POST">
<div class="col-lg-7" style="padding-bottom:120px">
@include('admin.blocks.error')
  
        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
        <div class="form-group">
            <label>Username</label>
            <input class="form-control" name="txtUser" placeholder="Please Enter Username" />
        </div>
        <div class="passwordform-group">
            <label>Password</label>
            <input type="password" class="form-control" name="txtPass" placeholder="Please Enter Password" />
        </div>
        <div class="form-group">
            <label>RePassword</label>
            <input type="password" class="form-control" name="txtRePass" placeholder="Please Enter RePassword"/>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" name="txtEmail" placeholder="Please Enter Email" />
        </div>
        <div class="form-group">
            <label>User Level</label>
            <label class="radio-inline">
                <input name="rdoLevel" value="1" type="radio">Admin
            </label>
            <label class="radio-inline">
                <input name="rdoLevel" value="2" type="radio" >Sale Admin
            </label>
            <label class="radio-inline">
                <input name="rdoLevel" value="3" type="radio" >Sale
            </label>
            <label class="radio-inline">
                <input name="rdoLevel" value="4" type="radio" >Tech
            </label>
        </div>
        <button type="submit" class="btn btn-success">User Add</button>
        <button type="reset" class="btn btn-success">Reset</button>
    
</div>
<form>
@endsection
