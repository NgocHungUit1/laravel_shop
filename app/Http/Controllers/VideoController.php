<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\Video;
use File;
use DB;
use App\Models\SLider;
use App\Models\Brand;
use App\Models\Category;


use Illuminate\Support\Facades\Auth;

session_start();

class VideoController extends Controller
{
    public function AuthLogin()
    {
        $admin_id = Auth::id();
        if ($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }
    public function video()
    {
        return view('admin.video.video_list');
    }
    public function insert_video(Request $request)
    {
        $data = $request->all();

        $vid = new Video();
        $sub_link = substr($data['video_link'], 17);
        $vid->video_title = $data['video_title'];
        $vid->video_slug = $data['video_slug'];
        $vid->video_link = $sub_link;
        $vid->video_desc = $data['video_desc'];
        $get_image = $request->file('file');
        if ($get_image) {

            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/video', $new_image);

            $vid->video_image = $new_image;
        }
        $vid->save();
    }
    public function update_video(Request $request)
    {
        $data = $request->all();
        $video_id = $data['video_id'];
        $video_update = $data['video_update'];
        $video_check = $data['video_check'];

        $vid = Video::find($video_id);
        if ($video_check == "video_title") {

            $vid->video_title = $video_update;
        } elseif ($video_check == "video_desc") {

            $vid->video_desc = $video_update;
        } elseif ($video_check == "video_link") {

            $sub_link = substr('video_update', 17);
            $vid->video_link = $sub_link;
        } else {

            $vid->video_slug = $video_update;
        }
        $vid->save();
    }
    public function update_video_img(Request $request)
    {
        $get_image = $request->file('file');
        $video_id = $request->video_id;

        if ($get_image) {
                $vid=Video::find($video_id);
                unlink('public/uploads/video/' . $vid->video_image);
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
                $get_image->move('public/uploads/video', $new_image);
               
              
                $vid->video_image = $new_image;
               
                $vid->save();
            
        }

    }
    public function delete_video(Request $request)
    {
        $data = $request->all();
        $video_id = $data['video_id'];
        $vid = Video::find($video_id);



        $vid->delete();
    }

    public function select_video(Request $request)
    {

        $video = Video::orderBy('video_id', 'DESC')->get();
        $video_count = $video->count();

        $output = '<form>
       ' . csrf_field() . '
       <table class="table table-striped b-t b-light">
       <thead>
         <tr>
           
           <th> STT</th>
           <th>Tên Video</th>
           <th>SLug</th>
           <th>Link</th>
           <th>Hình ảnh video</th>
           <th>mô tả</th>
           <th>Demo video</th>           
           <th style="width:30px;">Quản lý</th>
         </tr>
       </thead>
       <tbody>
   ';
        if ($video_count > 0) {
            $i = 0;
            foreach ($video as $key => $vid) {
                $i++;
                $output .= '
          
       <tr>
                <td>' . $i . '</td>
                <td contenteditable data-video_id="' . $vid->video_id . '" data-video_type="video_title" class="video_edit" id="video_title_' . $vid->video_id . '">' . $vid->video_title . '</td>
                <td contenteditable data-video_id="' . $vid->video_id . '" data-video_type="video_slug" class="video_edit" id="video_slug_' . $vid->video_id . '">' . $vid->video_slug . '</td>
                <td contenteditable data-video_id="' . $vid->video_id . '" data-video_type="video_link" class="video_edit" id="video_link_' . $vid->video_id . '">' . $vid->video_link . '</td>
                <td> 
                 <img src="' . url('public/uploads/video/' . $vid->video_image) . '" class "img-thumbnail" width="120" height="120">
                 <input type="file" class="file_img_video" data-video_id="'. $vid->video_id. '" id="file-video-'.  $vid->video_id . '" name="file" accept="image/*" />
                 </td>
                <td contenteditable data-video_id="' . $vid->video_id . '" data-video_type="video_desc" class="video_edit" id="video_desc_' . $vid->video_id . '">' . $vid->video_desc . '</td>
                <td><iframe width="200" height="200" src="https://www.youtube.com/embed/' . $vid->video_link . '"  frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></td>
                
              
                <td><button type="button" data-video_id="' . $vid->video_id . '" class="btn btn-xs btn-danger btn-delete-video">Xóa</button></td>
       </tr>
      
       ';
            }
        } else {
            $output .= '
       <tr>
       <td colspan="4">Chưa có video</td>
       </tr>
       ';
        }

        $output .= '
   </tbody>
   </table>
   </form>
   ';
        echo $output;
    }
    public function video_home(Request $request)
    {
        $cate = Category::orderBy('category_id', 'desc')->where('category_status', '0')->get();
        $slider = Slider::orderBy('slider_id', 'DESC')->where('slider_status', '1')->take(4)->get();
        $all = DB::table('tbl_category_product')
            ->join('tbl_product', 'tbl_product.category_id', '=', 'tbl_category_product.category_id')
            ->orderby('tbl_category_product.category_id', 'desc')->get();

        $brand = Brand::orderBy('brand_id', 'desc')->where('brand_status', '0')->get();
        $all_video = Video::orderBy('video_id', 'desc')->limit(6)->get();
        return view('pages.video.video')->with(compact('cate', 'brand', 'all_video', 'all', 'slider'));
        
    }
    public function watch_video(Request $request){
        $video_id = $request->video_id;
        $vid=Video::find($video_id);
        $output['video_title']=$vid->video_title;
        $output['video_link']='<iframe width="100%" height="400" src="https://www.youtube.com/embed/' . $vid->video_link . '"  frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
        echo json_encode($output);
    }
}
