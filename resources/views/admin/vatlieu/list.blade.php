@extends('admin.master')
@section('controller','Vật Liệu')
@section('action','List')
@section('content')                    <!-- /.col-lg-12 -->
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
        <tr align="center">
            <th>STT</th>
            <th>Mã vật liệu</th>
            <th>Tên Vật Liệu</th>
            <th>Rộng</th>
            <th>Dài</th>
            <th>Đơn giá</th>
            <th>Chất liệu</th>
            <th>Yêu cầu</th>
            <th>Mô tả</th>
            <th>Xoá</th>
            <th>Sửa</th>
        </tr>
    </thead>
    <tbody>
        <?php $stt=0 ?>
        @foreach($data as $item)
            <?php $stt = $stt +1 ?>
            <tr class="even gradeC" align="center">
                <td>{!!$stt!!}</td>
                <td>{!!$item['ten_ma']!!}</td>
                <td>{!!$item['ten']!!}</td>
                <td>{!!$item['rong']!!}</td>
                <td>{!!$item['dai']!!}</td>
                <td>{!!$item['don_gia']!!}</td>
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
                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="{!!URL::route('delvatlieu',$item['id'])!!}"onclick="return xacnhanxoa('Bạn có muốn xóa vật liệu này')">Xóa</a></td>
                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{!!URL::route('getEdit',$item['id'])!!}">Sửa</a></td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection

