@extends('admin.master')
@section('controller','Vật dụng')
@section('action','Add')
@section('content')
                    <!-- /.col-lg-12 -->
<form action="" method="POST" enctype="multipart/form-data" id="vatdung_add">
<div class="col-lg-7" style="padding-bottom:120px">
 @include('admin.blocks.error')
    
     <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
        <div class="form-group">
             <label>Tên Vật Dụng</label>
             <input class="form-control" name="txt_vd" placeholder="Nhập tên vật dụng" />
         </div>
         <div class="form-group">
             <label>Chi tiết vật dụng</label>
             <table class="table table-striped table-bordered table-hover">
               <thead>
                     <tr align="center">
                         <th>Tên vật liệu</th>
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
                 <tbody  id="chon_nl" cout ="{!!$cout!!}">
                        <tr class="odd gradeX" align="center" style="display:none">
                             <td>
                             <select class="form-control" id = "select_vl_hide" name="vatlieu[]">
                                <option value="">Chọn vật liệu</option>
                                @foreach($data as $item)
                                    <option value='{!!$item["id"]!!}'>{!!$item['ten']!!}</option>
                                @endforeach 
                             </select>    
                             </td>
                             <td><input class="form-control" id="{!!$item['id']!!}" name="soLuong[]" style="text-align:right" type="number" min="0"></input></td>
                             <td>cái</td>
                             <td><a id="del_row1" class="btn glyphicon glyphicon-remove" type="button"></td>
                        </tr>

                       <tr class="odd gradeX" align="center" id="rowvd_1">
                             <td>
                             <select class="form-control" id = "select_vl" name="vatlieu[]">
                                <option value="">Chọn vật liệu</option>
                                @foreach($data as $item)
                                    <option value='{!!$item["id"]!!}'>{!!$item['ten']!!}</option>
                                @endforeach 
                             </select>    
                             </td>
                             <td><input class="form-control" id="{!!$item['id']!!}" name="soLuong[]" style="text-align:right" type="number" min="0"></input></td>
                             <td>cái</td>
                             <td><a id="del_row1" class="btn glyphicon glyphicon-remove" onclick ="return del_row_vl(1)" type="button"></td>
                        </tr>
                    
                </tbody>
            </table>
         </div>
         <div class="form-group">
             <button type="button" class="btn btn-primary" id='btn_them_nl'>Chọn thêm vật liệu</button>
         </div>
         
         <div id="insert_erro"></div>

        <div class="form-group">
             <label>Phụ phí</label>
             <input class="form-control" placeholder="Nhập phụ phí" name="txt_phuphi" />
        </div>
        <div class="form-group">
            <label>Mô tả vật dụng</label>
            <textarea class="form-control" rows="3" name="txt_mo_ta"></textarea>
        </div>
         <button  type="button" class="btn btn-success" onclick="return checkvd()">
            Thêm Vật Dụng
         </button>
         <button type="reset" class="btn btn-success">
             Reset
         </button>
<form>
</div>

<form>

    @endsection
