@extends('admin.master')
@section('controller','Vật Dụng')
@section('action','List')
@section('content')                    <!-- /.col-lg-12 -->
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
 @include('admin.blocks.error')
     <input type="hidden" name="_token1" value="{!! csrf_token() !!}" />
    <thead>
        <tr align="center">
            <th>STT</th>
            <th>Tên</th>
            <th>Mã Vật Dụng</th>
            <th>Mô tả</th>
            <th>Đơn giá (VND)</th>
            <th>Chi tiết</th>
            <th>Xóa</th>
            <th>Sửa</th>
        </tr>
    </thead>
    <tbody>
        <?php $stt=0 ?>
        @foreach($data as $item)
            <?php $stt = $stt +1 ?>
            <tr class="even gradeC" align="center">
                <td>{!!$stt!!}</td>
                <td>{!!$item["ten"]!!}</td>
                <td>{!!$item["ma_vat_dung"]!!}</td>
                <td>{!!$item["mo_ta"]!!}</td>
                <td>{!!$item["don_gia"]!!}</td>
                <td class="center"><a href ="{{URL::route('chitietVD',$item['id'])}}">Chi tiết</a></td>
                <td class="center"><i class="fa fa-trash-o fa-fw"></i><a  href="{{URL::route('delvatdung',$item['id'])}}" onclick="return xacnhanxoa('Bạn có muốn xóa vật dụng này')">Xóa</a></td>
                <td class="center"><a  href ="{{URL::route('getEditVD',$item['id'])}}">Sửa</a></td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection

