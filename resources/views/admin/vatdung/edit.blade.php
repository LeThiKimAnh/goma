@extends('admin.master')
@section('controller','Product')
@section('action','Edit')
@section('content')
<form action="" method="POST" enctype="multipart/form-data">
<div class="col-lg-7" style="padding-bottom:120px">
 @include('admin.blocks.error')
    
     <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
        <div class="form-group">
             <label>Tên Vật Dụng</label>
             <input class="form-control" name="txt_vd" placeholder="Nhập tên vật dụng" value="{!!$vat_dung['ten']!!}" />
         </div>
         <div class="form-group">
             <label>Chi tiết vật dụng</label>
             <table class="table table-striped table-bordered table-hover">
               <thead>
                     <tr align="center">
                         <th>STT</th>
                         <th>Tên vật liệu</th>
                         <th>Số lượng</th>
                         <th>Đơn Vị</th>
                     </tr>
                </thead>
                <?php
                    $cout =0;
                     foreach ($data as $item) {
                        $cout =$cout +1;
                    } ?>
                 <tbody  id="chon_nl" cout ="{!!$cout!!}">
                       <tr class="odd gradeX" align="center" id="tr">
                             <td>1</td>
                             <td>
                             <select class="form-control" id = "select" name="vatlieu[]">
                                <option value="">Please Choose Product</option>
                                @foreach($data as $item)
                                    <option value='{!!$item["id"]!!}'>{!!$item['ten']!!}</option>
                                @endforeach 
                             </select>    
                             </td>
                             <td><input class="form-control" id="{!!$item['id']!!}" name="soLuong[]"></input></td>
                             <td>cái</td>
                        </tr>
                    
                </tbody>
            </table>
         </div>
         <button type="button" class="btn btn-primary" id='btn_them_nl'>Chọn thêm vật liệu</button>
         <div id="insert_erro" class="alert alert-success"></div>
           <div class="form-group">
            <label>Mô tả vật dụng</label>
            <textarea class="form-control" rows="3" name="txt_mo_ta"></textarea>
        </div>
         <button type="submit" class="btn btn-success">
            Lưu
         </button>
         <button type="reset" class="btn btn-success">
             Reset
         </button>
<form>
</div>

<form>
@endsection

