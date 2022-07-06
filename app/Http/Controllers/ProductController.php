<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SLider;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;
use File;
use App\Models\Gallery;

session_start();

class ProductController extends Controller
{
    public function add_product()
    {
        // $this->AuthLogin();
        $cate_product = Category::orderby('category_id', 'desc')->get();

        $brand_product = Brand::orderby('brand_id', 'desc')->get();

        return view('admin.product.add_product')->with(compact('cate_product', 'brand_product'));
    }
    public function all_product()
    {
        // $this->AuthLogin();
        $all_product = Product::with('brand', 'category')->orderBy('product_id', 'DESC')->get();

        return view('admin.product.all_product')->with(compact('all_product'));


    }
    public function save_product(Request $request)
    {
        // $this->AuthLogin();
     
        $data = array();
    	$data['product_name'] = $request->product_name;
        $data['product_quantity'] = $request->product_quantity;
      
    	$data['product_price'] = $request->product_price;
    	$data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;
        $data['product_image'] = $request->product_status;
        $get_image = $request->file('product_image');
      
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product',$new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->insert($data);
            Session::put('message','Thêm sản phẩm thành công');
            return Redirect::to('add-product');
        }
        $data['product_image'] = '';
    	DB::table('tbl_product')->insert($data);
    	Session::put('message','Thêm sản phẩm thành công');
    	return Redirect::to('all-product');
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
    public function edit_product($product_id)
    {

        $edit_product = Product::where('product_id', $product_id)->get();

        $brand_product = Brand::orderBy('brand_id', 'DESC')->get();
        $cate_product = Category::orderBy('category_id', 'DESC')->get();

        return view('admin.product.edit_product')->with(compact('edit_product', 'brand_product', 'cate_product'));

    }
    public function delete_product($product_id){
       
        DB::table('tbl_product')->where('product_id',$product_id)->delete();
        Session::put('message','Xóa sản phẩm thành công');
        return Redirect::to('all-product');
    }
    public function update_product(Request $request, $product_id)
    {
        // $this->AuthLogin();
        $data = $request->all();

        $product = Product::find($product_id);
        $product->product_name = $data['product_name'];
        $product->product_quantity=$data['product_quantity'];
        $product->product_desc = $data['product_desc'];
        $product->product_status = $data['product_status'];
        $product->product_content = $data['product_content'];
        $product->product_price = $data['product_price'];
        $product->category_id = $data['product_cate'];
        $product->brand_id = $data['product_brand'];
        $product->product_image = $data['product_image'];

        // $get_image = $request->product_image;
        //  if($get_image){
        // $path = 'public/uploads/product/';
        // $get_name_image = $get_image->getClientOriginalName();
        // $name_image = current(explode('.',$get_name_image));
        // $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
        // $get_image->move($path,$new_image);
        // $product->product_image = $new_image;

        $get_image = $request->product_image;
        if ($get_image) {
            $path = 'public/uploads/product/' . $product->product_image;
            if (file_exists($path)) {
                unlink($path);
            }
            $path = 'public/uploads/product/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);

            $product->product_image = $new_image;
        }
        $product->save();

        Session::put('message', 'Cập nhật  sản phẩm thành công');
        return Redirect::to('all-product');
    }
    public function delete_brand_product($brand_product_id)
    {
        // $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id', $brand_product_id)->delete();
        Session::put('message', 'Xóa thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }
    public function details_product($product_id)
    {
        $slider = Slider::orderBy('slider_id', 'DESC')->where('slider_status', '1')->take(4)->get();
        $cate = Category::orderBy('category_id', 'desc')->where('category_status', '0')->get();

        $product_details = DB::table('tbl_product')
            ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
            ->where('tbl_product.product_id', $product_id)->get();
        foreach ($product_details as $key => $value) {
            $category_id = $value->category_id;
            $product_id=$value->product_id;
            $product_cate=$value->category_name;
            $product_breadcrum=$value->product_name;

        }
        //gallery
        $gallery=Gallery::where('product_id',$product_id)->get();
        // updateviews
        $product=Product::where('product_id',$product_id)->first();
        $product->product_views=$product->product_views +1;
        $product->save();

        $relate = DB::table('tbl_product')
            ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
            ->where('tbl_category_product.category_id', $category_id)->whereNotIn('tbl_product.product_id', [$product_id])->orderby(DB::raw('RAND()'))->paginate(3);

        $brand = Brand::orderBy('brand_id', 'desc')->where('brand_status', '0')->get();

        return view('pages.details.show_details')->with(compact('cate', 'brand', 'product_details', 'relate','slider','gallery','product_cate','product_breadcrum'));

    }
    public function quickview(Request $request){
        $product_id=$request->product_id;
        $product = Product::find($product_id);
        $gallery=Gallery::where('product_id',$product_id)->get();
        $output['product_gallery']='';
        foreach($gallery as $key=> $gal){
            $output['product_gallery'].='<p><img width="100%" src="public/uploads/gallery/'.$gal->gallery_image.'">
            </p>'; 
        }
        $output['product_name']=$product->product_name;
        $output['product_id']=$product->product_id;
        $output['product_desc']=$product->product_desc;
        $output['product_content']=$product->product_content;
        $output['product_price']=number_format($product->product_price,0,',','.').'VNĐ';
        $output['product_image']='<p><img width="20%" src="public/uploads/product/'.$product->product_image.'">
        </p>'; 
        $output['product_quickview_value']='
                            <input type="hidden" value="{{$product->product_id}}" class="cart_product_id_{{$product->product_id}}">
                            <input type="hidden" value="'.$product->product_name.'" class="cart_product_name_'.$product->product_id.'">
                            <input type="hidden" value="{{$product->product_image}}" class="cart_product_image_{{$product->product_id}}">
                            <input type="hidden" value="{{$product->product_quantity}}" class="cart_product_quantity_{{$product->product_id}}">
                            <input type="hidden" value="{{$product->product_price}}" class="cart_product_price_{{$product->product_id}}">
                            <input type="hidden" value="1" class="cart_product_qty_{{$product->product_id}}">';

        echo json_encode($output);

    }

}
