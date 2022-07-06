@extends('layout')
@section('content')
<div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mb-4">



  <h2 class="title text-center">Video</h2>

  @foreach($all_video as $key => $video)
  <div class="col-sm-4">
    <div class="product-image-wrapper">

      <div class="single-products">
        <div class="productinfo text-center">
          <form>
            @csrf


            <a href="">
              <img width="50%" height="100" src="{{asset('public/uploads/video/'.$video->video_image)}}"  alt="" />
              <h2>{{$video->video_title}}</h2>
              <p>{{$video->video_desc}}</p>


            </a>

            <button type="button" class="btn btn-primary watch-video" data-toggle="modal" data-target="#modal_video" id="{{$video->video_id}}">Xem video</button>
          </form>

        </div>

      </div>

    </div>
  </div>
  @endforeach
</div>
<!--features_items-->
<ul class="pagination pagination-sm m-t-none m-b-none">

</ul>
<!--/recommended_items-->
<div class="modal fade" id="modal_video" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="video_title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="video_link">

        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>

      </div>
    </div>
  </div>
</div>
@endsection