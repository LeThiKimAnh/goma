@extends('admin.master')
@section('controller','Vật Liệu')
@section('action','Edit')
@section('content')
<form action="" method="POST" enctype="multipart/form-data">
<div class="col-lg-7" style="padding-bottom:120px">
 @include('admin.blocks.error')
    
     <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
        <div class="form-group">
             <label>Tên Vật Liệu</label>
             <input class="form-control" name="txt_ten" value="{!!$vat_lieu['ten']!!}" placeholder="Nhập tên vật liệu" />
         </div>
         <div class="form-group">
             <label>rộng</label>
             <input class="form-control" name="txt_chieu_rong" value="{!!$vat_lieu['rong']!!}" placeholder="Nhập chiều rộng" value="{{old('txt_ten')}}" type="number" min="0"></input>
         </div>
         <div class="form-group">
             <label>dài</label>
             <input class="form-control" name="txt_chieu_dai" value="{!!$vat_lieu['dai']!!}" placeholder="Nhập chiều dài" value="{{old('txt_ten')}}" type="number" min="0"></input>
         </div>
         <div class="form-group">
             <label>dày</label>
             <input class="form-control" name="txt_chieu_cao" value="{!!$vat_lieu['cao']!!}" placeholder="Nhập chiều cao" value="{{old('txt_ten')}}" type="number" min="0"></input>
         </div>
         <div class="form-group">
             <label>Chất liệu</label>
             @if($vat_lieu['chat_lieu']==1)
                 <select class="form-control" name="sl_chat_lieu">
                    <option value="">Hãy chọn chất liệu</option>
                    <option value='1' selected="true">gỗ</option>
                    <option value='2'>sắt</option>
                 </select>
             @elseif($vat_lieu['chat_lieu']==2)
                 <select class="form-control" name="sl_chat_lieu">
                    <option value="">Hãy chọn chất liệu</option>
                    <option value='1'>gỗ</option>
                    <option value='2' selected="true">sắt</option>
                 </select>
             @endif
         </div>
         <div class="form-group">
             <label>Yêu cầu</label>
             @if($vat_lieu['yeu_cau']==1)
                 <select class="form-control" name="sl_yeu_cau">
                    <option value="">Hãy chọn yêu cầu</option>
                    <option value='1' selected="true">vân ngang</option>
                    <option value='2'>vân dọc</option>
                    <option value='0'>không vân</option>
                 </select>
             @elseif($vat_lieu['yeu_cau']==2)
                 <select class="form-control" name="sl_yeu_cau">
                    <option value="">Hãy chọn yêu cầu</option>
                    <option value='1'>vân ngang</option>
                    <option value='2' selected="true">vân dọc</option>
                    <option value='0'>không vân</option>
                 </select>
             @elseif($vat_lieu['yeu_cau']==0)
                 <select class="form-control" name="sl_yeu_cau">
                    <option value="">Hãy chọn yêu cầu</option>
                    <option value='1'>vân ngang</option>
                    <option value='2'>vân dọc</option>
                    <option value='0' selected="true">không vân</option>
                 </select>
             @endif
         </div>
       <div class="form-group">
        <label>Mô tả vật liệu</label>
        <textarea class="form-control" rows="3" name="txt_mo_ta">{!!$vat_lieu['mo_ta']!!}</textarea>
        </div>
         <button type="submit" class="btn btn-success">
            Lưu lại
         </button>
         <button type="reset" class="btn btn-success">
             Reset
         </button>
<form>
</div>

<form>

@endsection

