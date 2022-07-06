<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Session;
use App\Models\SLider;

session_start();

class CartController extends Controller
{
    public function gio_hang(Request $request)
    {
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();
        $cate = Category::orderBy('category_id', 'desc')->where('category_status', '0')->get();

        $brand = Brand::orderBy('brand_id', 'desc')->where('brand_status', '0')->get();
        return view('pages.cart.cart_ajax')->with(compact('cate', 'brand','slider'));

    }
    public function delete_product($session_id)
    {
        $cart = Session::get('cart');

        if ($cart == true) {
            foreach ($cart as $key => $val) {
                if ($val['session_id'] == $session_id) {
                    unset($cart[$key]);
                }
            }
            Session::put('cart', $cart);
            return redirect()->back()->with('message', 'Xóa sản phẩm thành công');

        } else {
            return redirect()->back()->with('message', 'Xóa sản phẩm thất bại');
        }

    }
    public function update_cart(Request $request)
    {
        $data = $request->all();
        $cart = Session::get('cart');
        if ($cart == true) {
            $message = '';

            foreach ($data['cart_qty'] as $key => $qty) {
                $i = 0;
                foreach ($cart as $session => $val) {
                    $i++;

                    if ($val['session_id'] == $key && $qty < $cart[$session]['product_quantity']) {

                        $cart[$session]['product_qty'] = $qty;
                        $message .= '<p style="color:blue">' . $i . ') Cập nhật số lượng :' . $cart[$session]['product_name'] . ' thành công</p>';

                    } elseif ($val['session_id'] == $key && $qty > $cart[$session]['product_quantity']) {
                        $message .= '<p style="color:red">' . $i . ') Cập nhật số lượng :' . $cart[$session]['product_name'] . ' thất bại</p>';
                    }

                }

            }

            Session::put('cart', $cart);
            return redirect()->back()->with('message', $message);
        } else {
            return redirect()->back()->with('message', 'Cập nhật số lượng thất bại');
        }
    }
    public function add_cart_ajax(Request $request)
    {

        $data = $request->all();
        $session_id = substr(md5(microtime()), rand(0, 26), 5);
        $cart = Session::get('cart');
        if ($cart == true) {
            $is_avaiable = 0;
            foreach ($cart as $key => $val) {
                if ($val['product_id'] == $data['cart_product_id']) {
                    $is_avaiable++;
                }
            }
            if ($is_avaiable == 0) {
                $cart[] = array(
                    'session_id' => $session_id,
                    'product_name' => $data['cart_product_name'],
                    'product_id' => $data['cart_product_id'],
                    'product_image' => $data['cart_product_image'],
                    'product_quantity' => $data['cart_product_quantity'],
                    'product_qty' => $data['cart_product_qty'],
                    'product_price' => $data['cart_product_price'],
                );
                Session::put('cart', $cart);
            }
        } else {
            $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_quantity' => $data['cart_product_quantity'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],

            );
            Session::put('cart', $cart);
        }

        Session::save();

    }
}
