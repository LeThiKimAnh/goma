@extends('admin.master')
@section('controller','Đơn hàng')
@section('action',$action)
@section('content')

@if(Auth::user()->level==4)
<div class="form-group">
<form method="GET" action="{!!URL::route('SearchDH')!!}" name="form_search">
  <div class="col-lg-12">
    <div class="form-group col-lg-4">
      <label class="form-control-label col-sm-5">Mã đơn hàng :</label>
      <div class="col-sm-7">
        <input type="text" class="form-control" placeholder="Mã đơn hàng" name="txt_maDH" value="{!!$maDH!!}">
      </div>
    </div>

    <div class="form-group col-lg-4">
      <label class="form-control-label col-sm-5">Khách hàng :</label>
      <div class="col-sm-7">
        <input type="text" class="form-control" placeholder="Tên Khách hàng" name="txt_KH" value="{!!$tenKH!!}">
      </div>
    </div>

    <div class="form-group col-lg-4">
         <label class="form-control-label col-sm-5"> Hạn từ ngày:</label>
          <div id="datepicker1" class="input-group date col-sm-7" data-date-format="dd-mm-yyyy">
               <input class="form-control" type="text" name ="start_date" value="{!!$d1!!}"> <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span> 
          </div>
    </div>
  </div>
  <div class="col-lg-12">
    <div class="form-group col-lg-4">
        <label class="form-control-label col-sm-5">Người lập đơn:</label>
        <div class="col-sm-7">
          <input type="text" class="form-control" placeholder="Người lập đơn hàng" name="txt_NL" value="{!!$nguoi_TD!!}">
        </div>
    </div>

    <div class="form-group col-lg-4">
        <label class="form-control-label col-sm-5">Trạng thái :</label>
        <div class="col-sm-7">
          <select class="form-control" name="txt_TT" id="select_vd">
                <option value='2' selected="true">Đã xử lý</option>
                <option value='3'>Xử lý xong</option>
          </select>
        </div>
    </div>
    <div class="form-group col-lg-4">
          <label class="form-control-label col-sm-5">Đến ngày: </label>
          <div id="datepicker2" class="input-group date col-sm-7" data-date-format="dd-mm-yyyy">
             <input class="form-control" type="text" name ="end_date" value="{!!$d2!!}"> <span class="input-group-addon"><i class="glyphicon glyphicon-calendar" ></i></span> 
          </div>
    </div>
  </div>
    <div class="form-group col-lg-12">
      <button type="submit" class="btn btn-primary center-block">Tìm kiếm <i class="glyphicon glyphicon-search"></i></button>
    </div>
</form>
    <div class="form-group pull-right" >
  <button class="btn btn-default " onclick="return fnExcelReport()" >Xuất danh sách ra Excel</button>
</div>

 <table class="table table-striped table-bordered table-hover" id="dataTables">
   <thead>
         <tr align="center" name ="trdata">
             <th>STT</th>
             <th>Mã đơn hàng</th>
             <th>Khách hàng</th>
             <th>Người lập đơn</th>
             <th>Trạng thái</th>
             <th>Tác vụ</th>
           </tr>
    </thead>
     <?php $stt = 0 ?>
   
     <tbody id="myTable">
      @foreach($data as $item)
     <?php $stt = $stt + 1 ?>
           @if($item["trang_thai"]==2||$item["trang_thai"]==3)
           <tr class="odd gradeX clickable accordion-toggle" align="center " data-toggle="collapse" data-target="#accordion{!!$item['id']!!}" name ="trdata">
             <td>{!!$stt!!}</td>
             <td>{!!$item["ma_don_hang"]!!}</td>
             <td>{!!$item["khach_hang"]!!}</td>
             <td>{!!$item["nguoi_tao_don"]!!}</td>
             <td>
               @if($item["trang_thai"]==2)
                    Đã xử lý
               @elseif($item["trang_thai"]==3)
                    Xử lý xong
               @endif
             </td>
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
                    <form method="POST" action="{!!URL::route('deldonhang',$item['id'])!!}"> 
                      <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                      <button type="submit" class="btn btn-default" onclick="return xacnhanxoa('ban co chac la muon xoa khong')" data-toggle="tooltip" data-placement="top" title="Xóa đơn hàng"><i class="fa fa-trash-o fa-fw"></i>
                      </button>
                      </form>
                    </div>
                    <div class="col-lg-6">
                      <a type="button" class="btn btn-default" href="{{URL::route('getEditDH',$item['id'])}}" data-toggle="tooltip" data-placement="top" title="Sửa đơn hàng"><i class="fa fa-pencil fa-fw"></i></a>
                    </div>
                  </div>
                </div>
                @endif
                
                <div class=" form-group col-lg-2">
                  <div class="form-group">
                    <a href="{{URL::route('chitietDH',$item['id'])}}" class="centered-text"><h4>Chi tiết</h4></a>
                  </div>
                </div>
              </td>
              </div>
            </tr>
            @endif
            @endforeach  
    </tbody>
</table>
<div class="pull-right">
  {!! $data->render() !!}
</div>
<a id="back-to-top" href="#" class="btn btn-info btn-lg back-to-top" role="button" title="Trở về đầu trang" data-toggle="tooltip" data-placement="left"><span class="glyphicon glyphicon-chevron-up"></span></a>
    
  </div>
</form>
</div>
@else
<div class="form-group">
<form method="GET" action="{!!URL::route('SearchDH')!!}" name="form_search">
  <div class="col-lg-12">
    <div class="form-group col-lg-4">
      <label class="form-control-label col-sm-5">Mã đơn hàng :</label>
      <div class="col-sm-7">
        <input type="text" class="form-control" placeholder="Mã đơn hàng" name="txt_maDH" value="{!!$maDH!!}">
      </div>
    </div>

    <div class="form-group col-lg-4">
      <label class="form-control-label col-sm-5">Khách hàng :</label>
      <div class="col-sm-7">
        <input type="text" class="form-control" placeholder="Tên Khách hàng" name="txt_KH" value="{!!$tenKH!!}">
      </div>
    </div>

    <div class="form-group col-lg-4">
         <label class="form-control-label col-sm-5"> Hạn từ ngày:</label>
          <div id="datepicker1" class="input-group date col-sm-7" data-date-format="dd-mm-yyyy">
               <input class="form-control" type="text" name ="start_date" value="{!!$d1!!}"> <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span> 
          </div>
    </div>
  </div>
  <div class="col-lg-12">
    <div class="form-group col-lg-4">
        <label class="form-control-label col-sm-5">Người lập đơn:</label>
        <div class="col-sm-7">
          <input type="text" class="form-control" placeholder="Người lập đơn hàng" name="txt_NL" value="{!!$nguoi_TD!!}">
        </div>
    </div>

    <div class="form-group col-lg-4">
        <label class="form-control-label col-sm-5">Trạng thái :</label>
        <div class="col-sm-7">
          <select class="form-control" name="txt_TT" id="select_vd">
          @if($trang_thai ==0)
            <option value="" >Trạng thái</option>
                <option value='0' selected="true">Chưa xử lý</option>
                <option value='1' >Đang chờ xử lý</option>
                <option value='2'>Đã xử lý</option>
                <option value='3'>Xử lý xong</option>
          @endif
           @if($trang_thai ==1)
            <option value="" >Trạng thái</option>
                <option value='0' >Chưa xử lý</option>
                <option value='1' selected="true">Đang chờ xử lý</option>
                <option value='2'>Đã xử lý</option>
                <option value='3'>Xử lý xong</option>
          @endif
           @if($trang_thai ==2)
            <option value="" >Trạng thái</option>
                <option value='0' >Chưa xử lý</option>
                <option value='1' >Đang chờ xử lý</option>
                <option value='2' selected="true">Đã xử lý</option>
                <option value='3'>Xử lý xong</option>
          @endif
          @if($trang_thai ==-1)
            <option value="-1">Trạng thái</option>
                <option value='0' >Chưa xử lý</option>
                <option value='1' >Đang chờ xử lý</option>
                <option value='2'>Đã xử lý</option>
                <option value='3'>Xử lý xong</option>
          @endif
           @if($trang_thai ==3)
            <option value="-1">Trạng thái</option>
                <option value='0' >Chưa xử lý</option>
                <option value='1' >Đang chờ xử lý</option>
                <option value='2'>Đã xử lý</option>
                <option value='3' selected="true">Xử lý xong</option>
          @endif
          </select>   
        </div>
    </div>
    <div class="form-group col-lg-4">
          <label class="form-control-label col-sm-5">Đến ngày: </label>
          <div id="datepicker2" class="input-group date col-sm-7" data-date-format="dd-mm-yyyy">
             <input class="form-control" type="text" name ="end_date" value="{!!$d2!!}"> <span class="input-group-addon"><i class="glyphicon glyphicon-calendar" ></i></span> 
          </div>
    </div>
  </div>
    <div class="form-group col-lg-12">
      <button type="submit" class="btn btn-primary center-block">Tìm kiếm   <i class="glyphicon glyphicon-search"></i></button>
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

 <table class="table table-striped table-bordered table-hover" id="dataTables">
   <thead>
         <tr align="center" name ="trdata">
             <th>STT</th>
             <th>Mã đơn hàng</th>
             <th>Khách hàng</th>
             <th>Người lập đơn</th>
             <th>Trạng thái</th>
             @if(Auth::user()->level ==1||Auth::user()->level ==2)
             <th>Tác vụ</th>
             @endif
           </tr>
    </thead>
     <?php $stt = 0 ?>
   
     <tbody id="myTable">
      @foreach($data as $item)
     <?php $stt = $stt + 1 ?>
           <tr class="odd gradeX clickable accordion-toggle" align="center " data-toggle="collapse" data-target="#accordion{!!$item['id']!!}" name ="trdata">
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
               @elseif($item["trang_thai"]==3)
                    Xử lý xong
               @endif
             </td>
              @if(Auth::user()->level ==1||Auth::user()->level ==2)
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
                    <form method="POST" action="{!!URL::route('deldonhang',$item['id'])!!}"> 
                      <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                      <button type="submit" class="btn btn-default" onclick="return xacnhanxoa('ban co chac la muon xoa khong')" data-toggle="tooltip" data-placement="top" title="Xóa đơn hàng"><i class="fa fa-trash-o fa-fw"></i>
                      </button>
                      </form>
                    </div>
                    <div class="col-lg-6">
                      <a type="button" class="btn btn-default" href="{{URL::route('getEditDH',$item['id'])}}" data-toggle="tooltip" data-placement="top" title="Sửa đơn hàng"><i class="fa fa-pencil fa-fw"></i></a>
                    </div>
                  </div>
                </div>
                @endif
                
                <div class=" form-group col-lg-2">
                  <div class="form-group">
                    <a href="{{URL::route('chitietDH',$item['id'])}}" class="centered-text"><h4>Chi tiết</h4></a>
                  </div>
                </div>
              </td>
              </div>
            </tr>
              @endforeach  
    </tbody>
</table>
<div class="pull-right">
  {!! $data->render() !!}
</div>
<a id="back-to-top" href="#" class="btn btn-info btn-lg back-to-top" role="button" title="Trở về đầu trang" data-toggle="tooltip" data-placement="left"><span class="glyphicon glyphicon-chevron-up"></span></a>
@endif
@endsection 
 
