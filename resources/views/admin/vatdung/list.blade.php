@extends('admin.master')
@section('controller','Vật Dụng')
@section('action','List')
@section('content')

<div class="form-group">
<form method="GET" action="{!!URL::route('SearchVD')!!}" name="form_search">
@include('admin.blocks.error')
  <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
  <div class="col-lg-12" style="">
    <div class="form-group col-lg-4">
      <label class="form-control-label col-sm-5">Mã vật dụng:</label>
      <div class="col-sm-7">
        <input type="text" class="form-control" placeholder="Mã vật dụng" name="txt_maVD" value="{!!old('txt_maDH')!!}">
      </div>
    </div>

    <div class="form-group col-lg-4">
      <label class="form-control-label col-sm-5">Tên vật dụng:</label>
      <div class="col-sm-7">
        <input type="text" class="form-control" placeholder="Tên Khách hàng" name="txt_VD">
      </div>
    </div>

    <div class="form-group col-lg-4">
        <label class="form-control-label col-sm-5">Giá sản xuất:</label>
        <div class="col-sm-7">
          <input type="text" class="form-control" placeholder="Người lập đơn hàng" name="txt_giaSX">
        </div>
    </div>
  </div>
  <div class="col-lg-12">
    <div class="form-group col-lg-4">
        <label class="form-control-label col-sm-5">Giá sản phẩm:</label>
         <div class="col-sm-7">
          <input type="text" class="form-control" placeholder="Người lập đơn hàng" name="txt_giaSP">
        </div>
    </div>

    <div class="form-group col-lg-4">
        <label class="form-control-label col-sm-5">Hệ số:</label>
         <div class="col-sm-7">
          <input type="text" class="form-control" placeholder="hệ số" name="txt_HS">
        </div>
    </div>
  </div>

    <div class="col-lg-12"></div>
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
  <button class="btn btn-default " onclick="return fnExcelReport()" >Xuất danh sách ra Exel</button>
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
            <th>Chi tiết</th>
            <th>Xóa</th>
            <th>Sửa</th>
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
                <td class="center"><a href ="{{URL::route('chitietVD',$item['id'])}}">Chi tiết</a></td>
                <td class="center"><i class="fa fa-trash-o fa-fw"></i><a  href="{{URL::route('delvatdung',$item['id'])}}" onclick="return xacnhanxoa('Bạn có muốn xóa vật dụng này')">Xóa</a></td>
                <td class="center"><i class="fa fa-pencil fa-fw"></i><a  href ="{{URL::route('getEditVD',$item['id'])}}">Sửa</a></td>
            </tr>
            <tr class="collapse" id="accordion{!!$item['id']!!}">
                <td colspan="6">
              <div >
                <div class="col-lg-1">
                </div>
                <div class="col-lg-9">
                  <div class=" col-lg-12">
                    <div class="col-lg-4"><h4>Tên vật dụng :</h4></div>
                    <div class="col-lg-8"><h4>{!!$item['ten']!!}</h4></div>
                  </div>
                  <div class=" col-lg-12">
                    <div class="col-lg-4"><h4>Giá sản xuất :</h4></div>
                    <div class="col-lg-8"><h4>{!!$item['gia_san_xuat']!!}</h4></div>
                  </div>
                  <div class="col-lg-12">
                    <div class="col-lg-4"><h4>Giá bán :</h4></div>
                    <div class="col-lg-8">
                          <h4>
                            {!!$item['gia_san_pham']!!}
                          </h4>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="col-lg-4"><h4>Hệ số :</h4></div>
                    <div class="col-lg-8"><h4>{!!$item['he_so']!!}</h4></div>
                  </div>
                  <div class="col-lg-12">
                    <div class="col-lg-4"><h4>Mô tả :</h4></div>
                    <div class="col-lg-8"><h4>{!!$item['mo_ta']!!}</h4></div>
                  </div>
                </div>
                <div class="form-group col-lg-2">
                  <div class="form-group">
                    <div class="col-lg-6">
                      <a type="button" class="btn btn-default" onclick="return xacnhanxoa('ban co chac la muon xoa khong')" href="{{URL::route('deldonhang',$item['id'])}}" data-toggle="tooltip" data-placement="top" title="Xóa đơn hàng"><i class="fa fa-trash-o fa-fw"></i></a>
                    </div>
                    <div class="col-lg-6">
                      <a type="button" class="btn btn-default" href="{{URL::route('getEditDH',$item['id'])}}" data-toggle="tooltip" data-placement="top" title="Sửa đơn hàng"><i class="fa fa-pencil fa-fw"></i></a>
                    </div>
                  </div>
                </div>
                <div class=" form-group col-lg-2">
                  <div class="form-group">
                    <a href="{{URL::route('chitietDH',$item['id'])}}" class="centered-text"><h3><i class="fa fa-eye" aria-hidden="true"></i>Chi tiết</h3></a>
                  </div>
                </div>
              </td>
            </tr>
        @endforeach
    </tbody>
</table>

<a id="back-to-top" href="#" class="btn btn-info btn-lg back-to-top" role="button" title="Trở về đầu trang" data-toggle="tooltip" data-placement="left"><span class="glyphicon glyphicon-chevron-up"></span></a>
@endsection

