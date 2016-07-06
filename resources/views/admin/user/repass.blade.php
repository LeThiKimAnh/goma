@extends('admin.master')
@section('controller',Auth::user()->username)
@section('action','RePass')
@section('content')
 
<div class="col-lg-7" style="padding-bottom:120px">
@include('admin.blocks.error')    
<form action="" method="POST">
    <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
        <div class="form-group">
            <label>Old Password</label>
            <input type="password" class="form-control" name="txtPass" placeholder="Nhập mật khẩu cũ" />
        </div>
        <div class="form-group">
            <label>New Password</label>
            <input type="password" class="form-control" name="txtPass" placeholder="Nhập mật khẩu mới" />
        </div>
        <div class="form-group">
            <label>RePassword</label>
            <input type="password" class="form-control" name="txtRePass" placeholder="Nhập lại mật khẩu mới" />
        </div>
        <button type="submit" class="btn btn-success">Lưu</button>
        <button type="reset" class="btn btn-success">Reset</button>
    <form>
</div>

@endsection
