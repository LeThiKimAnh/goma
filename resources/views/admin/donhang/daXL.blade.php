@extends('admin.master')
@section('controller','Đơn hàng')
@section('action',$action)
@section('content')
 <table class="table table-striped table-bordered table-hover" id="dataTables-example">
   <thead>
         <tr align="center">
             <th>ID</th>
             <th>Mã đơn hàng</th>
             <th>Khách hàng</th>
             <th>Người lập đơn</th>
             <th>Mô tả</th>
             <th>Tổng hóa đơn</th>
             <th>Ngày giao hàng</th>
             <th>Chi tiết</th>
             <th>Kết quả</th>
           </tr>
    </thead>
     <tbody>
     <?php $stt = 0 ?>
     @foreach($data as $item)
     <?php $stt = $stt + 1 ?>
           <tr class="odd gradeX" align="center">
             <td>{!!$stt!!}</td>
             <td>{!!$item["ma_don_hang"]!!}</td>
             <td>{!!$item["khach_hang"]!!}</td>
             <td>{!!$item["nguoi_tao_don"]!!}</td>
             <td>{!!$item["mo_ta"]!!}</td>
             <td>{!!$item["tong_gia"]!!}</td>
             <td>
                  <?php 
                     $d = getdate(strtotime($item["ngay_giao_hang"]));
                     print $d['mday'].'/'.$d['mon'].'/'.$d['year'];
                   ?>  
             </td>
             <td class="center"><a href="{{URL::route('chitietDaXL',$item['id'])}}"> Chi tiết</a></td>
             <td class="center"><a href="{!!URL::route('result',$item['id'])!!}">Kết quả</a></td>
            </tr>
      @endforeach
          
    </tbody>
</table>
  @endsection 
 
