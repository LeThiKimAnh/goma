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
            @if(Auth::user()->level ==1)
            <th>Delete</th>
            <th>Edit</th>
            @endif
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
                   Admin
                @endif
                @if($item['level']==2)
                    Sale Admin
                @endif
                @if($item['level']==3)
                    Sale
                @endif
                @if($item['level']==4)
                    Tech
                @endif
            
            </td>
            @if(Auth::user()->level ==1)
            <td class="center" style="padding:2px;">
                <form method="POST" action="{!!URL::route('delUser',$item['id'])!!}"> 
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                    <button type="submit" class="btn btn-link" onclick="return xacnhanxoa('ban co chac la muon xoa khong')">
                        <i class="fa fa-trash-o fa-fw"></i>
                        Xóa
                    </button>
                </form>
            </td>
            <td class="center"  style="padding:2px;"> <a href="{!!URL::route('getEditUser',$item['id'])!!}" class="btn btn-link"><i class="fa fa-pencil fa-fw"></i> Sửa</a></td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>
@endsection

