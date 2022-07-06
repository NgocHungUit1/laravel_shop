<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;
use App\Models\SLider;

session_start();

class BrandProduct extends Controller
{
    public function add_brand_product()
    {
        // $this->AuthLogin();
        return view('admin.brand.add_brand_product');
    }
    public function all_brand_product()
    {
        // $this->AuthLogin();

        $all_brand_product = Brand::orderBy('brand_id', 'DESC')->get();
     
        return view('admin.brand.all_brand_product')->with(compact('all_brand_product'));

    }
    public function save_brand_product(Request $request)
    {
        // $this->AuthLogin();
        $data = $request->all();

        $brand = new Brand();
        $brand->brand_name = $data['brand_product_name'];
        // $brand->brand_slug = $data['brand_slug'];
        $brand->brand_desc = $data['brand_product_desc'];
        $brand->brand_status = $data['brand_product_status'];
        $brand->save();

        Session::put('message', 'Thêm thương hiệu sản phẩm thành công');
        return Redirect::to('add-brand-product');
    }
    public function unactive_brand_product($brand_product_id)
    {
        // $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id', $brand_product_id)->update(['brand_status' => 1]);
        Session::put('message', 'Không kích hoạt thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');

    }
    public function active_brand_product($brand_product_id)
    {
        // $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id', $brand_product_id)->update(['brand_status' => 0]);
        Session::put('message', 'Kích hoạt thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');

    }
    public function edit_brand_product($brand_product_id)
    {
        // $this->AuthLogin();

        $edit_brand_product = Brand::where('brand_id', $brand_product_id)->get();
     

        return view('admin.brand.edit_brand_product')->with(compact('edit_brand_product'));
    }
    public function update_brand_product(Request $request, $brand_product_id)
    {
        // $this->AuthLogin();
        $data = $request->all();
        $brand = Brand::find($brand_product_id);
        // $brand = new Brand();
        $brand->brand_name = $data['brand_product_name'];
        // $brand->brand_slug = $data['brand_product_slug'];
        $brand->brand_desc = $data['brand_product_desc'];
        $brand->brand_status = $data['brand_product_status'];
        $brand->save();
        // $data = array();
        // $data['brand_name'] = $request->brand_product_name;
        // $data['brand_slug'] = $request->brand_slug;
        // $data['brand_desc'] = $request->brand_product_desc;
        // DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update($data);
        Session::put('message', 'Cập nhật thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }
    public function delete_brand_product($brand_product_id)
    {
        // $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id', $brand_product_id)->delete();
        Session::put('message', 'Xóa thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }
//end admin branprodcut

    public function home_brand_product($brand_id)
    {
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();

        $cate = Category::orderBy('category_id', 'desc')->where('category_status', '0')->get();

        $brand = Brand::orderBy('brand_id', 'desc')->where('brand_status', '0')->get();

        $bigon = DB::table('tbl_product')->join('tbl_brand', 'tbl_product.brand_id', '=', 'tbl_brand.brand_id')->where('tbl_product.brand_id', $brand_id)->get();

        return view('pages.brand.home_brand')->with(compact('cate', 'brand', 'bigon','slider'));

    }
}
