@extends('admin.master')
@section('controller','Đơn hàng')
@section('action','List')
@section('content')
 <table class="table table-striped table-bordered table-hover" id="dataTables-example">
   <thead>
         <tr align="center">
             <th>ID</th>
             <th>Mã đơn hàng</th>
             <th>Khách hàng</th>
             <th>Người lập đơn</th>
             <th>Mô tả</th>
             <th>Trạng thái</th>
             <th>Chi tiết</th>
             <th>Delete</th>
             <th>Edit</th>
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
             <td>
               @if($item["trang_thai"]==0)
                    Chưa xử lý
               @elseif($item["trang_thai"]==1)
                    Đang chờ xử lý
                @else
                    Đã xử lý
               @endif
             </td>
             <td class="center"></i><a href="{{URL::route('chitietDH',$item['id'])}}"> Chi tiết</a></td>
             <td class="center"></i><a onclick="return xacnhanxoa('ban co chac la muon xoa khong')" href="{{URL::route('deldonhang',$item['id'])}}">Xóa</a></td>
             <td class="center"></i> <a href="{{URL::route('getEditDH',$item['id'])}}">Sửa</a></td>
            </tr>
      @endforeach
          
    </tbody>
</table>
  @endsection 
 
