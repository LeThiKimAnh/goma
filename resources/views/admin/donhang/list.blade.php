@extends('admin.master')
@section('controller','Đơn hàng')
@section('action',$action)
@section('content')

<div class="form-group">
@include('admin.blocks.error')
        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
  <div class="form-group col-lg-6">
  <form method="POST" action="{!!URL::route('listByMa')!!}">
          <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
    <label>Mã đơn hàng :</label>
    <div class="input-group">
      <input type="text" class="form-control" placeholder="Tìm kiếm theo Mã đơn hàng" name="txt_maDH" value="{!!old('txt_maDH')!!}">
        <span class="input-group-btn">
            <button class="btn btn-default" type="submit">
                <i class="glyphicon glyphicon-search"></i>
            </button>
        </span>
    </div>
    </form>
  </div>
  <div class="form-group col-lg-6">
    <form method="POST" action="{!!URL::route('listByNameKH')!!}">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
      <label>Khách hàng :</label>
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Tìm kiếm theo Khách hàng" name="txt_KH">
            <span class="input-group-btn">
                <button class="btn btn-default" type="submit">
                    <i class="glyphicon glyphicon-search"></i>
                </button>
            </span>
        </div>
    </form>
  </div>
  <div class="form-group col-lg-6">
    <form method="POST" action="{!!URL::route('listByNL')!!}">
          <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
      <label>Người lập đơn :</label>
        <div class="input-group">
          <!-- <label for="exampleInputName2">Mã đơn hàng</label> -->
          <input type="text" class="form-control" placeholder="Tìm kiếm theo Người lập đơn" name="txt_NL">
            <span class="input-group-btn">
                <button class="btn btn-default" type="submit" href="">
                    <i class="glyphicon glyphicon-search"></i>
                </button>
            </span>
        </div>
    </form>
  </div>
  <div class="form-group col-lg-6">
    <form method="POST" action="{!!URL::route('listByDate')!!}">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
      <div class="col-lg-5 form-line">
        <label>Từ ngày:</label>
          <div id="datepicker" class="input-group date" data-date-format="dd-mm-yyyy">
             <input class="form-control" type="text" readonly="" name = "start_date"> <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span> 
          </div>
      </div>

      <div class=" col-lg-5">
        <label>đến ngày:</label>
        <div id="datepicker1" class="input-group date" data-date-format="dd-mm-yyyy">
           <input class="form-control" type="text" readonly=""  name = "end_date"> <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span> 
        </div>
      </div>
      <div class=" col-lg-2">
       <label>tìm :</label>
          <button class="btn btn-default" type="submit">
              <i class="glyphicon glyphicon-search"></i>
          </button>
      </div>
    </form>
  </div>

</div>


</div>
<div class="col-lg-12  ">
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


<div class="form-group" >
  <button class="btn btn-primary" onclick="return fnExcelReport()" >Xuất danh sách ra Exel</button>
  <button class="btn btn-primary" onclick="return printData()" >Print</button>
</div>

 <table class="table table-striped table-bordered table-hover" id="dataTables" border="1">
   <thead>
         <tr align="center">
             <th>STT</th>
             <th>Mã đơn hàng</th>
             <th>Khách hàng</th>
             <th>Người lập đơn</th>
             <th>Trạng thái</th>
<!--              <th>Chi tiết</th> -->
             <th>Xóa</th>
             <th>Sửa</th>
           </tr>
    </thead>
     <?php $stt = 0 ?>
    @foreach($data as $item)
     <tbody>
     <?php $stt = $stt + 1 ?>
           <tr class="odd gradeX clickable" align="center" data-toggle="collapse" data-target="#accordion{!!$item['id']!!}">
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
             <!-- <td>
                  <?php 
                     // $d = getdate(strtotime($item["ngay_giao_hang"]));
                     // print $d['mday'].'/'.$d['mon'].'/'.$d['year'];
                   ?>  
             </td> -->
           <!--   <td class="center"></i><a href="{{URL::route('chitietDH',$item['id'])}}"> Chi tiết</a></td> -->
             <td class="center"></i><a onclick="return xacnhanxoa('ban co chac la muon xoa khong')" href="{{URL::route('deldonhang',$item['id'])}}">Xóa</a></td>
             <td class="center"></i> <a href="{{URL::route('getEditDH',$item['id'])}}">Sửa</a></td>
            </tr>
            <tr class="hiddenRow" colspan="7">
              <td >
                <div class="accordion-body collapse" id="accordion{!!$item['id']!!}">
                  <div class="form-group">
                    <label>hehe</label>
                  </div>
                </div>
              </td>
            </tr>
          
    </tbody>
      @endforeach
</table>

  @endsection 
 
