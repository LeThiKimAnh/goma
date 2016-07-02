@extends('admin.master')
@section('controller','Dashboard')
@section('action','Statistics Overview')
@section('content')

<div class="row">
    <div class="col-lg-6 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{!!$so_don_hang!!}</div>
                        <div>Số đơn hàng hiện có</div>
                    </div>
                </div>
            </div>
            <a href="{!!URL::route('listDh')!!}">
                <div class="panel-footer">
                    <span class="pull-left">Xem chi tiết</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-6 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-tasks fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{!!$so_don_hang_daxl!!}</div>
                        <div>Số đơn hàng đã xử lý</div>
                    </div>
                </div>
            </div>
            <a href="{!!URL::route('listDhDaXL')!!}">
                <div class="panel-footer">
                    <span class="pull-left">Xem chi tiết</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
<!-- /.row -->
<div class="row">
  <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i>Đơn hàng mới gần đây nhất</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Date</th>
                                <th>Ten_KH</th>
                                <th>Hóa đơn (VND)</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $item)
                            <tr>
                                <td>{!!$item["ma_don_hang"]!!}</td>
                                <td> 
                                    <?php 
                                     $d = getdate(strtotime($item["created_at"]));
                                     print $d['mday'].'/'.$d['mon'].'/'.$d['year'];
                                     ?>              
                                </td>
                                <td>{!!$item["khach_hang"]!!}</td>
                                <td>{!!$item["tong_gia"]!!}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-right">
                    <a href="{!!URL::route('listDh')!!}">Xem tất cả đơn hàng<i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
   <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i>Đơn hàng đã xử lý</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Date</th>
                                <th>Ten_KH</th>
                                <th>Hóa đơn(VND)</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($data_don_hang_daxl as $item)
                            <tr>
                                <td>{!!$item["ma_don_hang"]!!}</td>
                                <td>
                                    <?php 
                                        $d = getdate(strtotime($item["created_at"]));
                                        print $d['mday'].'/'.$d['mon'].'/'.$d['year'];
                                     ?>  
                                </td>
                                <td>{!!$item["khach_hang"]!!}</td>
                                <td>{!!$item["tong_gia"]!!}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-right">
                    <a href="{!!URL::route('listDhDaXL')!!}">Xem chi tiết <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i>Đơn hàng chưa xử lý</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                               <th>Mã đơn hàng</th>
                                <th>Date</th>
                                <th>Ten_KH</th>
                                <th>Hóa đơn(VND)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data_don_hang_chxl as $item)
                                <tr>
                                     <td>{!!$item["ma_don_hang"]!!}</td>
                                <td>
                                    <?php 
                                        $d = getdate(strtotime($item["created_at"]));
                                        print $d['mday'].'/'.$d['mon'].'/'.$d['year'];
                                     ?>  
                                </td>
                                <td>{!!$item["khach_hang"]!!}</td>
                                <td>{!!$item["tong_gia"]!!}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-right">
                    <a href="{!!URL::route('listDhCXL')!!}">Xem chi tiết <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection