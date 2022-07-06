<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\SLider;


class CategoryProduct extends Controller
{
    public function add_category_product()
    {
        return view('admin.category.add_category_product');
    }
    public function all_category_product()
    {

        $all_category_product = Category::orderBy('category_id', 'DESC')->get();  
        return view('admin.category.all_category_product')->with(compact('all_category_product'));

    }
    public function save_category_product(Request $request)
    {

        $data = array();

        $data['category_name'] = $request->category_product_name;
        /* $data['meta_keywords'] = $request->category_product_keywords;*/
        /* $data['slug_category_product'] = $request->slug_category_product;*/
        $data['category_desc'] = $request->category_product_desc;
        $data['category_status'] = $request->category_product_status;

        DB::table('tbl_category_product')->insert($data);
        Session::put('message', 'Thêm danh mục sản phẩm thành công');
        return Redirect::to('add-category-product');
    }
    public function unactive_category_product($category_product_id)
    {

        DB::table('tbl_category_product')->where('category_id', $category_product_id)->update(['category_status' => 1]);
        Session::put('message', 'Không kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');

    }
    public function active_category_product($category_product_id)
    {

        DB::table('tbl_category_product')->where('category_id', $category_product_id)->update(['category_status' => 0]);
        Session::put('message', 'Kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }
    public function edit_category_product($category_product_id)
    {

        $edit_category_product =Category::where('category_id', $category_product_id)->get();
        return view('admin.category.edit_category_product')->with(compact('edit_category_product'));
       
    }
    public function update_category_product(Request $request, $category_product_id)
    {

        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['meta_keywords'] = $request->category_product_keywords;
        $data['slug_category_product'] = $request->slug_category_product;
        $data['category_desc'] = $request->category_product_desc;
        DB::table('tbl_category_product')->where('category_id', $category_product_id)->update($data);
        Session::put('message', 'Cập nhật danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }
    public function delete_category_product($category_product_id)
    {

        DB::table('tbl_category_product')->where('category_id', $category_product_id)->delete();
        Session::put('message', 'Xóa danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }
    //end function admin page
    public function home_category_product($category_id)
    {
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();
        $cate = Category::orderBy('category_id', 'desc')->where('category_status', '0')->get();

        $brand = Brand::orderBy('brand_id', 'desc')->where('brand_status', '0')->get();
        $all_product = Product::orderBy('product_id', 'desc')->where('product_status', '0')->limit(6)->get();
      
        $category_name = Category::orderBy('category_id', 'desc')->where('tbl_category_product.category_id', $category_id)->limit(1)->get();
        $category_by_id=Category::where('category_id',$category_id)->get();
        foreach($category_by_id as $key =>$category ){
            $id_cate=$category->category_id;
        }

        if(isset($_GET['sort_by'])){
          echo $sort_by=$_GET['sort_by'];
            
            if($sort_by=='giam_dan'){
                $bigon=Product::with('category')->where('category_id',$id_cate)->orderBy('product_price','DESC')->paginate(6)->appends(request()->query());

            }elseif($sort_by=='tang_dan'){
                $bigon=Product::with('category')->where('category_id',$id_cate)->orderBy('product_price','ASC')->paginate(6)->appends(request()->query());

            }
        }
        else{
           

        }
         $bigon = DB::table('tbl_product')->join('tbl_category_product', 'tbl_product.category_id', '=', 'tbl_category_product.category_id')->where('tbl_product.category_id', $category_id)->paginate(6);

        return view('pages.category.home_category')->with(compact('cate', 'brand', 'all_product', 'bigon', 'category_name','slider'));

    }
}
