@extends('admin.master')
@section('content')

<div class="col-lg-11" style="padding-bottom:120px">
<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
    <li data-target="#myCarousel" data-slide-to="3"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox"  width="1920 px" height="1200 px">
    <div class="item active">
      <img src="{{url('admin/images/anh1.jpg')}}" alt="Chania">
    </div>

    <div class="item">
      <img src="{{url('admin/images/anh2.jpg')}}" alt="Chania">
    </div>

    <div class="item">
      <img src="{{url('admin/images/anh3.jpg')}}" alt="Chania" alt="Flower">
    </div>

    <div class="item">
      <img src="{{url('admin/images/anh4.jpg')}}" alt="Chania" alt="Flower">
    </div>
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