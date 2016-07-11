@extends('admin.master')
@section('content')
<script>
	var solution = <?php print $session->sketch; ?>;
	var imageObj = new Image();
	imageObj.src = '/admin/images/WLsci.png';

	function random_color() {
		var color = [0, 0, 0];
		for (var i = 0; i <= 2; i++) {
			if (Math.random() < 0.66666) {
				color[i] = 32 + parseInt(Math.random() * 192);
			}
		}
		return 'rgb(' + color[0] + ',' + color[1] + ',' + color[2] + ')';
	}

	function createCanvas(panel, idx) {
		var canvas = document.createElement('canvas');
		canvas.setAttribute('id', 'canvas' + idx);
		canvas.setAttribute('class', 'img');

		canvas.width = 2400;
		canvas.height = 1200;

		var ctx = canvas.getContext('2d');
		ctx.scale(0.425, 0.425);

		var pattern = ctx.createPattern(imageObj, 'repeat');

		ctx.beginPath();
		ctx.lineWidth = 3;
		ctx.rect(0, 0, 2400, 1200);
		ctx.strokeStyle = 'black';
		ctx.stroke();

		var rects = panel.rects;
		var remains = panel.remains;

		if (rects.length < 1) {
			return null;
		}

		for (var i = 0; i < rects.length; i++) {
			var rect = rects[i];
			ctx.fillStyle = random_color();
			ctx.fillRect(rect[1], rect[0], rect[2], rect[3]);
		}

		for (var i = 0; i < remains.length; i++) {
			var rect = remains[i];
			ctx.beginPath();
			ctx.rect(rect[1], rect[0], rect[2], rect[3]);
			ctx.fillStyle = pattern;
			ctx.fill();
			ctx.lineWidth = 3;
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
		for (var i = 0; i < panels.length; i++) {
			var canvas = createCanvas(panels[i], i);
			if (canvas === null) {
				continue;
			}

			var wrapper = document.createElement('div');
			var indicator = document.createElement('li');

			var clazz = "item";
			if (i === 0) {
				clazz = "item active";
				indicator.setAttribute('class', 'active');
			}
			wrapper.setAttribute('class', clazz);
			indicator.setAttribute('data-slide-to', i);
			indicator.setAttribute('data-target', '#myCarousel');

			wrapper.appendChild(canvas);
			parent.appendChild(wrapper);
			indicators.appendChild(indicator);
		}
	}
	// show after 1 second
	setTimeout(show, 1000);
</script>

<div class="col-lg-12" style="padding-bottom:120px">
	<div id="myCarousel" class="carousel slide" data-ride="carousel">
		<!-- Indicators -->
		<ol id ='slide-indicator' class="carousel-indicators">
		</ol>

		<!-- Wrapper for slides -->
		<div id="slider" class="carousel-inner" role="listbox" style="height: 512px">
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
@endsection