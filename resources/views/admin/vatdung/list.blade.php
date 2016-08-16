@extends('admin.master')
@section('controller','Sản Phẩm')
@section('action','List')
@section('content')

<div class="form-group">
<form method="GET" action="{!!URL::route('SearchVD')!!}" name="form_search">
  
    <div class="form-group col-lg-4">
      <label class="form-control-label col-sm-5">Mã sản phẩm:</label>
      <div class="col-sm-7">
        <input type="text" class="form-control" placeholder="Mã sản phẩm" name="txt_maVD" value="{!!$maVD!!}">
      </div>
    </div>

    <div class="form-group col-lg-4">
      <label class="form-control-label col-sm-5">Tên:</label>
      <div class="col-sm-7">
        <input type="text" class="form-control" placeholder="Tên sản phẩm" name="txt_VD" value="{!!$tenVD!!}">
      </div>
    </div>

    @if(Auth::user()->level==1||Auth::user()->level==2)
    <div class="form-group col-lg-4">
        <label class="form-control-label col-sm-5">Giá sản xuất:</label>
        <div class="col-sm-7">
          <input type="text" class="form-control" placeholder="Giá sản xuất" name="txt_giaSX" value="{!!$gia_SX!!}">
        </div>
    </div>
    @endif
  </div>

    <div class="form-group col-lg-4">
        <label class="form-control-label col-sm-5">Giá bán:</label>
         <div class="col-sm-7">
          <input type="text" class="form-control" placeholder="Giá bán" name="txt_giaSP" value="{!!$gia_SP!!}">
        </div>
    </div>
  @if(Auth::user()->level==1||Auth::user()->level==2)
    <div class="form-group col-lg-4">
        <label class="form-control-label col-sm-5">Hệ số:</label>
         <div class="col-sm-7">
          <input type="text" class="form-control" placeholder="Hệ số" name="txt_HS" value="{!!$he_so!!}">
        </div>
    </div>
  @endif
 
    <div class="form-group col-lg-12">
      <button type="submit" class="btn btn-primary center-block">Tìm kiếm  <i class="glyphicon glyphicon-search"></i></button>
    </div>
  </div>
</form>
</div>


<div class="col-lg-12 ">
    @if(Session::has('flash_message1'))
        <div class="alert alert-danger {!! Session::get('flash_level') !!}">
            {!! Session::get('flash_message1') !!}
        </div>
    @elseif(Session::has('flash_message2'))
        <div class="alert alert-success {!! Session::get('flash_level') !!}">
            {!! Session::get('flash_message2') !!}
        </div>
    @endif
</div>

<div class="form-group pull-left" >
  <a type="button" class="btn btn-default " href="{!!URL::route('getVatdung')!!}">Thêm sản phẩm</a>
</div>

<div class="form-group pull-right" >
  <button class="btn btn-default " onclick="return fnExcelReport()" >Xuất danh sách ra Excel</button>
</div>

                    <!-- /.col-lg-12 -->
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
 @include('admin.blocks.error')
     <input type="hidden" name="_token1" value="{!! csrf_token() !!}" />
    <thead>
        <tr align="center" name ="trdata">
            <th>STT</th>
            <th>Mã Vật Dụng</th>
            <th>Tên</th>
            @if(Auth::user()->level==1||Auth::user()->level==2)
            <th>Giá sản xuất</th>
            @endif
            <th>Giá sản phẩm</th>
            @if(Auth::user()->level==1||Auth::user()->level==2)
            <th>Xóa</th>
            <th>Sửa</th>
            @endif
        </tr>
    </thead>
    <tbody >
        <?php $stt=0 ?>
        @foreach($data as $item)
            <?php $stt = $stt +1 ?>
            <tr class="odd gradeX clickable accordion-toggle" align="center " data-toggle="collapse" data-target="#accordion{!!$item['id']!!}" name ="trdata">
                <td>{!!$stt!!}</td>
                <td>{!!$item["ma_vat_dung"]!!}</td>
                <td>{!!$item["ten"]!!}</td>
                @if(Auth::user()->level==1||Auth::user()->level==2)
                <td>{!!$item['gia_san_xuat']!!}</td>
                @endif
                <td>{!!$item['gia_san_pham']!!}</td>
                @if(Auth::user()->level==1||Auth::user()->level==2)
                <td class="center" style="padding:2px;"> <form method="POST" action="{!!URL::route('delvatdung',$item['id'])!!}"> <input type="hidden" name="_token" value="{!! csrf_token() !!}" /><button type="submit" class="btn btn-link" onclick="return xacnhanxoa('ban co chac la muon xoa khong')"><i class="fa fa-trash-o fa-fw"></i> Xóa</button></form></td>
                <td class="center" style="padding:2px;"><a class="btn btn-link" href="{{URL::route('getEditVD',$item['id'])}}"><i class="fa fa-pencil fa-fw"></i> Sửa</a></td>
                @endif
            </tr>
            <tr class="collapse" id="accordion{!!$item['id']!!}">
                <td colspan="7">
              <div >
                <div class="col-lg-1">
                </div>
                <div class="col-lg-9">
                  <div class=" col-lg-12">
                    <div class="col-lg-4"><h4>Tên vật dụng :</h4></div>
                    <div class="col-lg-8"><h4>{!!$item['ten']!!}</h4></div>
                  </div>
                  @if(Auth::user()->level==1||Auth::user()->level==2)
                  <div class=" col-lg-12">
                    <div class="col-lg-4"><h4>Giá sản xuất :</h4></div>
                    <div class="col-lg-8"><h4>{!!$item['gia_san_xuat']!!}</h4></div>
                  </div>
                  @endif
                  <div class="col-lg-12">
                    <div class="col-lg-4"><h4>Giá bán :</h4></div>
                    <div class="col-lg-8">
                          <h4>
                            {!!$item['gia_san_pham']!!}
                          </h4>
                    </div>
                  </div>
                  @if(Auth::user()->level==1||Auth::user()->level==2)
                  <div class="col-lg-12">
                    <div class="col-lg-4"><h4>Hệ số :</h4></div>
                    <div class="col-lg-8"><h4>{!!$item['he_so']!!}</h4></div>
                  </div>
                  @endif
                  <div class="col-lg-12">
                    <div class="col-lg-4"><h4>Mô tả :</h4></div>
                    <div class="col-lg-8"><h4>{!!$item['mo_ta']!!}</h4></div>
                  </div>
                </div>
                <div class=" form-group col-lg-2">
                  <div class="form-group">
                    <a href="{{URL::route('chitietVD',$item['id'])}}" class="centered-text"><h4>Chi tiết</h4></a>
                  </div>
                  @if(Auth::user()->level==1||Auth::user()->level==2||Auth::user()->level==3)
                  <div class="form-group">
                    <button type="button" class="btn btn-link centered-text" data-toggle="modal" data-target="#myModal" data-params="<?php echo $item['id'];?>"><h4>Lịch sử giá</h4></button>
                  </div>
                  @endif
                </div>
               
              </td>
            </tr>
        @endforeach
    </tbody>
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog" style="z-index:10241;width: 800px" >

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Lịch sử giá</h4>
          </div>
          <div class="modal-body">
            <div class="chartContainer" style="height: 400px"> </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>
</table>
<div class="pull-right">
  {!! $data->render() !!}
</div>

<a id="back-to-top" href="#" class="btn btn-info btn-lg back-to-top" role="button" title="Trở về đầu trang" data-toggle="tooltip" data-placement="left"><span class="glyphicon glyphicon-chevron-up"></span></a>
@endsection

