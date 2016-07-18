@extends('admin.master')
@section('controller','Vật Dụng')
@section('action','List')
@section('content')

<div class="form-group">
<form method="GET" action="{!!URL::route('SearchVD')!!}" name="form_search">
  
    <div class="form-group col-lg-4">
      <label class="form-control-label col-sm-5">Mã vật dụng:</label>
      <div class="col-sm-7">
        <input type="text" class="form-control" placeholder="Mã vật dụng" name="txt_maVD" value="{!!$maVD!!}">
      </div>
    </div>

    <div class="form-group col-lg-4">
      <label class="form-control-label col-sm-5">Tên vật dụng:</label>
      <div class="col-sm-7">
        <input type="text" class="form-control" placeholder="Tên vật dụng" name="txt_VD" value="{!!$tenVD!!}">
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
        <label class="form-control-label col-sm-5">Giá sản phẩm:</label>
         <div class="col-sm-7">
          <input type="text" class="form-control" placeholder="Giá sản phẩm" name="txt_giaSP" value="{!!$gia_SP!!}">
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
                </div>
              </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="pull-right">
  {!! $data->render() !!}
</div>

<a id="back-to-top" href="#" class="btn btn-info btn-lg back-to-top" role="button" title="Trở về đầu trang" data-toggle="tooltip" data-placement="left"><span class="glyphicon glyphicon-chevron-up"></span></a>
@endsection

