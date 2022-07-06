<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Models\SLider;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Redirect;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
   
     public function timkiem(Request $request){
        $data = $request->all();
        $cate = Category::orderBy('category_id','desc')->where('category_status','0')->get();
        $brand =Brand::orderBy('brand_id','desc')->where('brand_status','0')->get();
        if($data['keywords']){
          
           $search_product = Product::where('product_name','LIKE','%'.$data['keywords'].'%')->get(); 
          
          
            $output = ' <ul class="dropdown-menu" style="display:block;">'
            ;

            foreach($search_product as $key => $tr){
             $output .= ' <li class="li_timkiem_ajax"><a href="#">'.$tr->product_name.'</a></li> ';
         }

         $output .= '</ul>';
         echo $output;
     }


    
}
 public function timkiemm(Request $request){
        $data = $request->all();
         $tukhoa=$data['tukhoa'];
         $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();
     

        $cate = Category::orderBy('category_id','desc')->where('category_status','0')->get();
        $brand =Brand::orderBy('brand_id','desc')->where('brand_status','0')->get();

        $search_product = Product::where('product_name','like','%'.$tukhoa.'%')->get(); 


        return view('pages.details.timkiem')->with(compact('cate','brand','search_product','slider'));

 
  
  

    }
}
