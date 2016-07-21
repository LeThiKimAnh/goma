@extends('admin.master')
@section('controller','Kho Gỗ')
@section('action','List')
@section('content')  
<div class="form-group">
<form method="GET" action="{!!URL::route('SearchGo')!!}" name="form_search">
  <div class="col-lg-12" style="">
    <div class="form-group col-lg-4">
      <label class="form-control-label col-sm-5">Tên gỗ:</label>
      <div class="col-sm-7">
        <input type="text" class="form-control" placeholder="Tên gỗ" name="txt_ten" value="{!!$tenVL!!}">
      </div>
    </div>

    <div class="form-group col-lg-4">
      <label class="form-control-label col-sm-5">Dài:</label>
      <div class="col-sm-7">
        <input type="text" class="form-control" placeholder="Chiều dài" name="txt_D" value="{!!$dai!!}">
      </div>
    </div>

    <div class="form-group col-lg-4">
        <label class="form-control-label col-sm-5">Rộng:</label>
        <div class="col-sm-7">
          <input type="text" class="form-control" placeholder="Chiều rộng" name="txt_R" value="{!!$rong!!}">
        </div>
    </div>
  </div>
  <div class="col-lg-12">
    <div class="form-group col-lg-4">
        <label class="form-control-label col-sm-5">Chất liệu:</label>
        @if($chat_lieu==1)
         <div class="col-sm-7">
          <select class="form-control" name="txt_CL" id="select_vd">
            <option value="" >Chất liệu</option>
                <option value='1' selected="true">gỗ</option>
                <option value='2' >sắt</option>
          </select>   
        </div>
        @endif
        @if($chat_lieu==2)
         <div class="col-sm-7">
          <select class="form-control" name="txt_CL" id="select_vd">
            <option value="" >Chất liệu</option>
                <option value='1' >gỗ</option>
                <option value='2' selected="true">sắt</option>
          </select>   
        </div>
        @endif
        @if($chat_lieu==-1)
         <div class="col-sm-7">
          <select class="form-control" name="txt_CL" id="select_vd">
            <option value="-1" >Chất liệu</option>
                <option value='1' >gỗ</option>
                <option value='2' >sắt</option>
          </select>   
        </div>
        @endif
    </div>

    <div class="form-group col-lg-4">
        <label class="form-control-label col-sm-5">Loại</label>
        <div class="col-sm-7">
            @if($loai==1)
             <select class="form-control" name="txt_YC">
                <option value="-1">Yêu cầu</option>
                <option value='1' selected="true">vân ngang</option>
                <option value='2'>vân dọc</option>
                <option value='0'>không vân</option>
             </select>
            @elseif($loai==2)
             <select class="form-control" name="txt_YC">
                <option value="-1">Yêu cầu</option>
                <option value='1'>vân ngang</option>
                <option value='2' selected="true">vân dọc</option>
                <option value='0'>không vân</option>
             </select>
            @elseif($loai==0)
             <select class="form-control" name="txt_YC">
                <option value="-1">Yêu cầu</option>
                <option value='1'>vân ngang</option>
                <option value='2'>vân dọc</option>
                <option value='0' selected="true">không vân</option>
             </select>
            @elseif($loai==-1)
             <select class="form-control" name="txt_YC">
                <option value="-1">Yêu cầu</option>
                <option value='1'>vân ngang</option>
                <option value='2'>vân dọc</option>
                <option value='0'>không vân</option>
             </select>
            @endif()

        </div>
  </div>

    <div class="col-lg-12"></div>
    <div class="form-group col-lg-12">
      <button type="submit" class="btn btn-primary center-block">Tìm kiếm  <i class="glyphicon glyphicon-search"></i></button>
    </div>
  </div>
</form>
</div>  
<div class="form-group pull-right" >
  <button class="btn btn-default " onclick="return fnExcelReport()" >Xuất danh sách ra Excel</button>
</div>                <!-- /.col-lg-12 -->
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
        <tr align="center" name ="trdata">
            <th>STT</th>
            <th>Tên Vật Liệu</th>
            <th>Rộng</th>
            <th>Dài</th>
            <th>Chất liệu</th>
            <th>Yêu cầu</th>
            <th>Mô tả</th>
            <th>Xoá</th>
            <!-- <th>Sửa</th> -->
        </tr>
    </thead>
    <tbody>
        <?php $stt=0 ?>
        @foreach($data as $item)
            <?php $stt = $stt +1 ?>
            <tr class="even gradeC" align="center" name ="trdata">
                <td>{!!$stt!!}</td>
                <td>{!!$item['ten']!!}</td>
                <td>{!!$item['rong']!!}</td>
                <td>{!!$item['dai']!!}</td>
                <td>
                    @if($item['chat_lieu']==1)
                        gỗ
                    @else
                        sắt
                    @endif
                </td>
                <td>
                     @if($item['yeu_cau']==1)
                        vân ngang
                    @elseif($item['yeu_cau']==2)
                        vân dọc
                    @else
                        không vân
                    @endif
                </td>
                <td>{!!$item['mo_ta']!!}</td>
                <td class="center" style="padding:2px;">
                    <form method="POST" action="{!!URL::route('delgothua',$item['id'])!!}"> <input type="hidden" name="_token" value="{!! csrf_token() !!}" /><button type="submit" class="btn btn-link" onclick="return xacnhanxoa('ban co chac la muon xoa khong')"><i class="fa fa-trash-o fa-fw"></i> Xóa</button></form>
                </td>
                <!-- <td class="center"  style="padding:2px;"> <a href="{!!URL::route('getEditGo',$item['id'])!!}" class="btn btn-link"><i class="fa fa-pencil fa-fw"></i> Sửa</a></td> -->
            </tr>
        @endforeach
    </tbody>
</table>
<div class="pull-right">
    {!! $data->render() !!}
</div>
<a id="back-to-top" href="#" class="btn btn-info btn-lg back-to-top" role="button" title="Trở về đầu trang" data-toggle="tooltip" data-placement="left"><span class="glyphicon glyphicon-chevron-up"></span></a>
@endsection

