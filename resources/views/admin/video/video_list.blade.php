@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Video List
    </div>
    <div class="row w3-res-tb">


      <div class="col-sm-12">
        <div class="position-center">
          <form>
            @csrf
            <div class="form-group">
              <label for="exampleInputEmail1">Tên Video</label>
              <input type="text" name="video_title" class="form-control video_title" onkeyup="ChangeToSlug();" id="slug" placeholder="Tên Video">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Slug video</label>
              <input type="text" name="video_slug" class="form-control video_slug" id="convert_slug" placeholder="Slug">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Link Video</label>
              <input type="text" name="link_video" class="form-control video_link" id="convert_slug" placeholder="Video link">
            </div>

            <div class="form-group">
              <label for="exampleInputPassword1"> Video DESC</label>
              <textarea style="resize: none" rows="8" class="form-control video_desc" name="video_desc" id="exampleInputPassword1" placeholder="Mô tả danh mục"></textarea>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1"> Video Image</label>
              <input type="file" class="form-control" id="file_img_video" name="file" accept="image/*">

            </div>


            <button type="button" name="add_video" class="btn btn-info btn-add-video">Thêm Video</button>
          </form>
          <div id="message"></div>

        </div>
      </div>
    </div>
    <div class="table-responsive">
      <?php
      $message = Session::get('message');
      if ($message) {
        echo '<span class="text-alert">' . $message . '</span>';
        Session::put('message', null);
      }
      ?>

      <div id="video_load"></div>
    </div>

  </div>
  <!-- Modal -->
  <div class="modal fade" id="video_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Video
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection