@extends('admin.master')
@section('controller','Vật Dụng')
@section('action','Detail')
@section('content')

<div class="col-lg-7" style="padding-bottom:120px">
    @include('admin.blocks.error')
        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
         <div class="form-group">
             <label>Tên Vật Dụng : {!!$vat_dung['ten']!!}</label>
         </div>
         <div class="form-group">
             <label>Mã vật dụng : {!!$vat_dung['ma_vat_dung']!!}</label>
         </div>
         
         <div class="form-group">
             <label>Chi tiết đơn hàng</label>
             <table class="table table-striped table-bordered table-hover">
               <thead>
                     <tr align="center">
                         <th>STT</th>
                         <th>Tên Vật liệu</th>
                         <th>Dài</th>
                         <th>Rộng</th>
                         <th>Chất liệu</th>
                         <th>Yêu cầu</th>
                         <th>Số lượng</th>
                         <th>Đơn Vị</th>
                     </tr>
                </thead>
                 <tbody>
                        <?php $stt = 0 ?>
                         @foreach($vat_lieus as $item)
                         <?php 
                            $stt = $stt + 1 ;
                         ?>
                       <tr class="odd gradeX" align="center">
                             <td>{!!$stt!!}</td>
                             <td>{!!$item->ten!!}</td>
                             <td>{!!$item->dai!!}</td>
                             <td>{!!$item->rong!!}</td>
                             @if($item->chat_lieu==1)
                                <td>gỗ</td>
                             @elseif($item->chat_lieu==2)
                                <td>sắt</td>
                             @endif
                             @if($item->yeu_cau==1)
                                <td>vân ngang</td>
                             @elseif($item->yeu_cau==2)
                                <td>vân dọc</td>
                             @elseif($item->yeu_cau==0)
                                <td>không vân</td>
                             @endif
                             <td>{!!$item->so_luong!!}</td>
                             <td>Cái</td>
                        </tr>
                        @endforeach
                    
                </tbody>
            </table>
            <div class="form-group">
             <a type="button" class="btn btn-primary" href="{!!URL::route('vd-getList')!!}">Quay lại danh sách</a>
         </div>
         </div>

</div>
@endsection
                