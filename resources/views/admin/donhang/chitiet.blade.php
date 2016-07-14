@extends('admin.master')
@section('controller','Đơn Hàng')
@section('action','Detail')
@section('content')



<div class="col-lg-7" style="padding-bottom:120px">
    @include('admin.blocks.error')
    <form method="POST" action="{!!URL::route('session',$id)!!}">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
         <div class="form-group">
             <label>Khách hàng : {{$don_hang['khach_hang']}}</label>
         </div>
         <div class="form-group">
             <label>Nguời lập đơn hàng : {{$don_hang['nguoi_tao_don']}}</label>
         </div>
         <div class="form-group">
             <label>Mã đơn hàng : {{$don_hang['ma_don_hang']}}</label>
         </div>
         <div class="form-group">
             <label>Chi tiết đơn hàng</label>
             <table class="table table-striped table-bordered table-hover">
               <thead>
                     <tr align="center">
                         <th>STT</th>
                         <th>Tên Vật dụng</th>
                         <th>Đơn giá</th>
                         <th>Số lượng</th>
                         <th>Đơn Vị</th>
                     </tr>
                </thead>
                 <tbody>
                        <?php $stt = 0 ?>
                         @foreach($vatdungs as $item)
                         <?php $stt = $stt + 1 ;
                         ?>
                       <tr class="odd gradeX" align="center">
                             <td>{!!$stt!!}</td>
                             <td>{!!$item->ten!!}</td>
                             <td>{!!$item->don_gia!!}</td>
                             <td>{!!$item->so_luong!!}</td>
                             <td>Cái</td>
                        </tr>
                        @endforeach
                    
                </tbody>
            </table>
            @if($check_tt==1)
            <div class="form-group">
             <a type="button" class="btn btn-primary" href="{!!URL::route('listDhDaXL')!!}">Quay lại danh sách</a>
            @else
            <div class="form-group">
            <a type="button" class="btn btn-primary" href="{!!URL::route('listDh')!!}">Quay lại danh sách</a>
            @endif
            @if($don_hang['trang_thai']==0)
                <button type="submit" class="btn btn-primary">Xử Lý</button>
            @endif
         </div id="insert_erro_vd">
         </div>
    </form>
</div>
@endsection
                