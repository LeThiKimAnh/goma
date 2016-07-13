@extends('admin.master')
@section('controller','Đơn hàng')
@section('action',$action)
@section('content')

<div class="form-group">
<form method="GET" action="{!!URL::route('SearchDH')!!}" name="form_search">
@include('admin.blocks.error')
  <input type="hidden" name="_token" value="{!! csrf_token() !!}" />

  <div class="form-group row col-lg-6">
    <label class="form-control-label col-sm-5">Mã đơn hàng :</label>
    <div class="col-sm-7">
      <input type="text" class="form-control" placeholder="Mã đơn hàng" name="txt_maDH" value="{!!old('txt_maDH')!!}">
    </div>
  </div>

  <div class="form-group row col-lg-6">
    <label class="form-control-label col-sm-5">Khách hàng :</label>
    <div class="col-sm-7">
      <input type="text" class="form-control" placeholder="Tên Khách hàng" name="txt_KH">
    </div>
  </div>

  <div class="form-group row col-lg-6">
      <label class="form-control-label col-sm-5">Người lập đơn :</label>
      <div class="col-sm-7">
        <input type="text" class="form-control" placeholder="Người lập đơn hàng" name="txt_NL">
      </div>
  </div>

  <div class="form-group row col-lg-6">
      <label class="form-control-label col-sm-5">Trạng thái :</label>
      <div class="col-sm-7">
        <select class="form-control" name="txt_TT" id="select_vd">
          <option value="" >Chọn tìm theo trạng thái</option>
              <option value='0'>Chưa xử lý</option>
              <option value='1'>Đang chờ xử lý</option>
              <option value='2'>Đã xử lý</option>
        </select>   
      </div>
  </div>

  <div class="form-group row col-sm-6">
      <label class="form-control-label col-sm-5">Ngày giao:</label>
      <div class="form-group row col-sm-7">
      <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 form-control-label">Từ: </label>
          <div id="datepicker1" class="input-group date col-sm-10" data-date-format="dd-mm-yyyy">
               <input class="form-control" type="text" name ="start_date"> <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span> 
          </div>
      </div>
          <label for="inputEmail3" class="col-sm-2 form-control-label">Đến: </label>
          <div id="datepicker2" class="input-group date col-sm-10" data-date-format="dd-mm-yyyy">
             <input class="form-control" type="text" name ="end_date"> <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span> 
          </div>
      </div>   
  </div>

  <div class="form-group col-lg-12">
    <button type="submit" class="btn btn-primary center-block" id="btn_them_vd">Tìm kiếm  <i class="glyphicon glyphicon-search"></i></button>
  </div>

</form>
</div>


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

 <table class="table table-striped table-bordered table-hover" id="dataTables">
   <thead>
         <tr align="center">
             <th>STT</th>
             <th>Mã đơn hàng</th>
             <th>Khách hàng</th>
             <th>Người lập đơn</th>
             <th>Trạng thái</th>
             <th>Tác vụ</th>
           </tr>
    </thead>
     <?php $stt = 0 ?>
    @foreach($data as $item)
     <tbody>
     <?php $stt = $stt + 1 ?>
           <tr class="odd gradeX clickable accordion-toggle" align="center " data-toggle="collapse" data-target="#accordion{!!$item['id']!!}" data-toggle="tooltip" data-placement="top" title="Xóa đơn hàng">
             <td>{!!$stt!!}</td>
             <td>{!!$item["ma_don_hang"]!!}</td>
             <td>{!!$item["khach_hang"]!!}</td>
             <td>{!!$item["nguoi_tao_don"]!!}</td>
             <td>
               @if($item["trang_thai"]==0)
                    Chưa xử lý
               @elseif($item["trang_thai"]==1)
                    Đang chờ xử lý
                @elseif($item["trang_thai"]==2)
                    Đã xử lý
               @endif
             </td>
              @if($item["trang_thai"]==0)
               <td>
                 <form method="POST" action="{!!URL::route('session',$item['id'])!!}">
                      <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                      <button type="submit" class="btn btn-primary">Xử Lý</button>
                 </form>
               </td>
              @endif
              @if($item["trang_thai"]==2)
                <td>
                  <a type="button" class="btn btn-success" href="{{URL::route('result',$item['id'])}}">Kết quả</a>
                </td>
              @endif
            </tr>
            <tr class="collapse" id="accordion{!!$item['id']!!}">
              <td colspan="7">
              <div >
                <div class="col-lg-1">
                </div>
                <div class="col-lg-9">
                  <div class="form-group">
                    <div class="col-lg-4"><h4>Khách Hàng :</h4></div>
                    <div class="col-lg-8"><h4>{!!$item['khach_hang']!!}</h4></div>
                  </div>
                  <div class="form-group">
                    <div class="col-lg-4"><h4>Người lập đơn hàng :</h4></div>
                    <div class="col-lg-8"><h4>{!!$item['nguoi_tao_don']!!}</h4></div>
                  </div>
                  <div class="form-group">
                    <div class="col-lg-4"><h4>Ngày lập đơn hàng :</h4></div>
                    <div class="col-lg-8">
                          <h4>
                            <?php 
                              $d = getdate(strtotime($item["created_at"]));
                               print $d['mday'].'/'.$d['mon'].'/'.$d['year'];
                            ?>  
                          </h4>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-lg-4"><h4>Ngày giao hàng :</h4></div>
                    <div class="col-lg-8">
                          <h4>
                            <?php 
                              $d1 = getdate(strtotime($item["ngay_giao_hang"]));
                               print $d1['mday'].'/'.$d1['mon'].'/'.$d1['year'];
                            ?>  
                          </h4>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-lg-4"><h4>Ngày sửa gần nhất :</h4></div>
                    <div class="col-lg-8">
                          <h4>
                            <?php 
                              $d2 = getdate(strtotime($item["updated_at"]));
                               print $d2['mday'].'/'.$d2['mon'].'/'.$d2['year'];
                            ?>  
                          </h4>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-lg-4"><h4>Tổng giá trị đơn hàng :</h4></div>
                    <div class="col-lg-8"><h4>{!!$item['tong_gia']!!}</h4></div>
                  </div>
                  <div class="form-group">
                    <div class="col-lg-4"><h4>Mô tả :</h4></div>
                    <div class="col-lg-8"><h4>{!!$item['mo_ta']!!}</h4></div>
                  </div>
                </div>
                @if($item["trang_thai"]==0)
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
                @endif
                <div class=" form-group col-lg-2">
                  <div class="form-group">
                    <a href="{{URL::route('chitietDH',$item['id'])}}" class="centered-text"><h3><i class="fa fa-eye" aria-hidden="true"></i>Chi tiết</h3></a>
                  </div>
                </div>
              </td>
              </div>
            </tr>
          
    </tbody>
      @endforeach
</table>
<a id="back-to-top" href="#" class="btn btn-info btn-lg back-to-top" role="button" title="Trở về đầu trang" data-toggle="tooltip" data-placement="left"><span class="glyphicon glyphicon-chevron-up"></span></a>

  @endsection 
 
