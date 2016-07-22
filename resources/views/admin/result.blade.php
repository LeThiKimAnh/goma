@extends('admin.master')
@section('controller','Kết quả')
@section('action','')
@section('content')
<script>
	var solution = <?php print $session->sketch; ?>;
	var imageObj = new Image();

	imageObj.src = "{{url('/admin/images/WLsci.png')}}";

	function createCanvas(panel, idx) {
		var canvas = document.createElement('canvas');
		var scale = 0.425;
		canvas.setAttribute('id', 'canvas' + idx);
		canvas.setAttribute('name', 'canvas');
		canvas.setAttribute('class', 'img');

		canvas.width = panel.width * scale;
		canvas.height = panel.height * scale;

		var ctx = canvas.getContext('2d');
		ctx.scale(scale, scale);

		var pattern = ctx.createPattern(imageObj, 'repeat');

		ctx.beginPath();
		ctx.lineWidth = 2;
		ctx.rect(0, 0, panel.width, panel.height);
		ctx.strokeStyle = 'black';
		ctx.stroke();
		ctx.fillStyle = "white";
		ctx.fill();

		var rects = panel.rects;
		var remains = panel.remains;

		if (rects.length < 1) {
			return null;
		}

		for (var i = 0; i < rects.length; i++) {
			var rect = rects[i];
			ctx.beginPath();
			ctx.rect(rect[1], rect[0], rect[2], rect[3]);
			ctx.lineWidth = 1;
			ctx.strokeStyle = 'black';
			ctx.stroke();
			ctx.font = "20px Arial";
			ctx.fillStyle = "black";

			var x = rect[1] + rect[2] / 2 - 5;
			var y = rect[0] + rect[3] / 2 + 10;

			if (rect[2] < 50) {
				ctx.save();
				ctx.translate(x, y);
				ctx.rotate(-Math.PI / 2);
				ctx.fillText(rect[4], 0, 10);
				ctx.restore();
			} else {
				ctx.fillText(rect[4], x, y);
			}
		}

		for (var i = 0; i < remains.length; i++) {
			var rect = remains[i];
			ctx.beginPath();
			ctx.rect(rect[1], rect[0], rect[2], rect[3]);
			ctx.fillStyle = pattern;
			ctx.fill();
			ctx.lineWidth = 1;
			ctx.strokeStyle = 'black';
			ctx.stroke();
		}
		return canvas;
	}

	function show() {
		var parent = document.getElementById('slider');
		var indicators = document.getElementById('slide-indicator');
		parent.innerHTML = "";
		indicators.innerHTML = "";

		var panels = solution['panels'];
		for (var i = 0, j = 0; i < panels.length; i++) {
			var panel = panels[i];
			var canvas = createCanvas(panel, i);
			if (canvas === null) {
				continue;
			}

			var wrapper = document.createElement('div');
			var indicator = document.createElement('li');
			var caption = document.createElement('div');
			var req = (panel.req === 0) ? "Không vân" : (panel.req === 1) ? "Vân dọc" : "Vân ngang";

			var clazz = "item";
			if (i === 0) {
				clazz = "item active";
				indicator.setAttribute('class', 'active');
			}
			canvas.setAttribute('style', 'display: inline');
			wrapper.setAttribute('class', clazz);
			wrapper.setAttribute('style', 'text-align: center;');
			indicator.setAttribute('data-slide-to', j);
			indicator.setAttribute('data-target', '#myCarousel');
			caption.setAttribute('class', 'carousel-caption');
			caption.innerHTML = '<h4> Panel ' + j + '</h4><p> ' + panel.width + ' x ' + panel.height + ' x ' + req + ' </p>';
			j += 1;

			wrapper.appendChild(canvas);
			wrapper.appendChild(caption);
			parent.appendChild(wrapper);
			indicators.appendChild(indicator);
		}
	}
	// show after 1 second
	setTimeout(show, 1000);
</script>
<style>
	.carousel {
		background-color: #000000;
		color: #000000;
		margin-bottom: 60px;
	}
	
	.carousel-control {
		width: 10%;
	}
	.carousel .item {
		height: 100%;
	}

	.container-fluid {
		padding-left: 5px;
		padding-right: 5px;
	}

</style>
<ol class="breadcrumb">
    <li class="active">
		<a href="{!!URL::route('listDh')!!}">
			<i class="glyphicon glyphicon-list-alt"></i> Danh Sách
		</a>
    </li>
    <li class="active">
        <i class="fa fa-edit"></i> Kết quả
    </li>
</ol>

<div class="form-group pull-right">
	<button class="btn btn-default " onclick="return printData();" >Print</button>
</div>

<div class="col-lg-12"  style="padding-bottom:20px;padding-left: 0;padding-right: 0">
	<div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
		<!-- Indicators -->
		<ol id ='slide-indicator' class="carousel-indicators">
		</ol>

		<!-- Wrapper for slides -->
		<div id="slider" class="carousel-inner" role="listbox" style="height: 512px;">
		</div>

		<!-- Left and right controls -->
		<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
</div>
<div class="form-group pull-right" >
	<button class="btn btn-default " onclick="return fnExcelReport()" >Xuất danh sách ra Excel</button>
</div>   
<table class="table table-striped table-bordered table-hover" id="dataTables" style="margin-bottom: 2cm;">
    <thead>
		<tr align="center" name ="trdata">
			<th>STT</th>
			<th>Tên Panel</th>
			<th>Dài</th>
			<th>Rộng</th>
			<th>Yêu cầu</th>
		</tr>
    </thead>
	<tbody id="myTable">
		<?php $stt = 1 ?>
		@foreach($panels as $panel)
		<tr class="odd gradeX clickable accordion-toggle" align="center " data-toggle="collapse" data-target="#accordion{{ $panel->id }}" name ="trdata">
			<td>{{ $stt++ }}</td>
			<td>{{ $panel->id }}</td>
			<td>{{ $panel->height }}</td>
			<td>{{ $panel->width }}</td>
			<td>
				@if($panel->req==1)
				vân ngang
				@elseif($panel->req==2)
				vân dọc
				@else
				không vân
				@endif
			</td>
		</tr>
		<tr class="collapse" id="accordion{{ $panel->id }}" name ="trdata">
			<td colspan="5">
				<div class="col-lg-1"></div>
				<div class="col-lg-10">
					<table class="table table-striped table-bordered table-hover">
						<thead>
						<th>STT</th>
						<th>Tên mã</th>
						<th>Top</th>
						<th>Left</th>
						<th>Dài</th>
						<th>Rộng</th>
						</thead>
						<tbody>
							<?php $sstt = 1; ?>
							@foreach($panel->rects as $rect)
							<tr>
								<td>{{ $sstt++ }}</td>
								<td>{{ $rect[4] }}</td>
								<td>{{ $rect[0] }}</td>
								<td>{{ $rect[1] }}</td>
								<td>{{ $rect[3] }}</td>
								<td>{{ $rect[2] }}</td>
							</tr>
							@endforeach  
						</tbody>
					</table>
				</div>
				<div class="col-lg-2">
				</div>
				<div class="col-lg-12">
					<div class="col-lg-11">

					</div>
					<div class="col-lg-1 pull-right">
						<div class="col-lg-4 ">
						</div>
						<div class="col-lg-4 ">
							<button data-toggle="collapse" data-target="#accordion{{ $panel->id }}" style="margin-bottom: 10px;"><i class="glyphicon glyphicon-chevron-up"></i> 
							</button>
						</div>
					</div>

				</div>
			</td>
			</div>

		</tr>
		@endforeach 
    </tbody>
</table>
<a id="back-to-top" href="#" class="btn btn-info btn-lg back-to-top" role="button" title="Trở về đầu trang" data-toggle="tooltip" data-placement="left"><span class="glyphicon glyphicon-chevron-up"></span></a>
@endsection