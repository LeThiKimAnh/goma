@extends('admin.master')
@section('controller','User')
@section('action','List')
@section('content')
<!-- /.col-lg-12 -->
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
        <tr align="center">
            <th>STT</th>
            <th>Username</th>
            <th>Level</th>
            <th>Delete</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
    <?php $stt = 0 ?>
    @foreach($data as $item)
        <?php $stt = $stt+1 ?>
        <tr class="odd gradeX" align="center">
            <td>{!!$stt!!}</td>
            <td>{!!$item['username']!!}</td>
            <td>@if($item['level']==1)
                    {!!"Admin"!!}
                @endif
                @if($item['level']==2)
                    {!!"Member"!!}
                @endif
            
            </td>
            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a onclick="return xacnhanxoa('ban co chac la muon xoa khong')" href="{!!URL::route('delUser',$item['id'])!!}"> Delete</a></td>
            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{!!URL::route('getEditUser',$item['id')]!!}">Edit</a></td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection

