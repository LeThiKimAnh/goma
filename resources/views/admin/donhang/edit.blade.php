@extends('admin.master')
@section('controller','Category')
@section('action','Edit')
@section('content')
<div class="col-lg-7" style="padding-bottom:120px">
    @include('admin.blocks.error')
    <form action="" method="POST" id="dh_edit">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
         <div class="form-group">
             <label>Khách hàng</label>
             <input class="form-control" name="txt_KH" placeholder="Nhập tên khách hàng" value="{!!$don_hang['khach_hang']!!}" />
         </div>
         <div class="form-group">
             <label>Chi tiết đơn hàng</label>
             <table class="table table-striped table-bordered table-hover">
               <thead>
                     <tr align="center">
                         <th>Tên Vật dụng</th>
                         <th>Số lượng</th>
                         <th>Đơn Vị</th>
                         <th>Xóa</th>
                     </tr>
                </thead>
                 <?php
                    $cout =0;
                     foreach ($data as $item) {
                        $cout =$cout +1;
                    } ?>
                 <tbody  id="chon_vd" cout ="{!!$cout!!}">
                        <tr class="odd gradeX" align="center" id="sample" style="display:none">
                             <td>
                             <select class="form-control" name="vatdung[]" id="select">
                                <option value="0" >Chọn Vật Dụng</option>
                                @foreach($data as $item)
                                    <option value='{!!$item["id"]!!}'>{!!$item['ten']!!}</option>
                                @endforeach 
                             </select>    
                             </td>
                             <td><input class="form-control" id="{!!$item['id']!!}" name="soLuong[]"></input></td>
                             <td>cái</td>
                             <td><a id="del_row1" class="btn glyphicon glyphicon-remove" onclick ="return del_row(1)" type="button"></td>
                        </tr>
                    @foreach($vatdungs as $vatdung)
                       <tr class="odd gradeX" align="center" id="row_1">
                             <td>
                             <select class="form-control" name="vatdung[]" id='select_vd'>
                                <option value="{!!$vatdung->id!!}" >{!!$vatdung->ten!!}</option>
                                @foreach($data as $item)
                                    <option value='{!!$item["id"]!!}'>{!!$item["ten"]!!}</option>
                                @endforeach 
                             </select>    
                             </td>
                             <td><input class="form-control" id="{!!$item['id']!!}" name="soLuong[]" value="{!!$vatdung->so_luong!!}"></input></td>
                             <td>cái</td>
                             <td><a id="del_row1" class="btn glyphicon glyphicon-remove" onclick ="return del_row(1)" type="button"></td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
         </div>
         <div class="form-group">
             <button type="button" class="btn btn-primary" id="btn_them_vd">Chọn thêm vật dụng</button>
         </div>
         <div id="insert_erro_vd_edit">
             
         </div>
            <?php 
                 $d = getdate(strtotime($don_hang["ngay_giao_hang"]));
             ?>  
        <div class="form-group">
            <label>Ngày giao hàng:</label>
            <div id="datepicker_edit" class="input-group date" data-date-format="dd-mm-yyyy">
             <input class="form-control" type="text" readonly=""  name = "date" value="" /> <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span> 
            </div>
        </div>

           <div class="form-group">
            <label>Mô tả đơn hàng</label>
            <textarea class="form-control" rows="3" name="txtDescription">{!!$don_hang['mo_ta']!!}</textarea>
        </div>
         <button  type="button" class="btn btn-success" onclick="return checkedit()">
            Lưu
         </button>
         <button type="reset" class="btn btn-success">
             Reset
         </button>
<form>
</div>
@endsection