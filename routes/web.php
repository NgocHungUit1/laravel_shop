<?php

use Illuminate\Support\Facades\Route;
 use App\Http\Controllers\HomeController;
  use App\Http\Controllers\AdminController;
  use App\Http\Controllers\CategoryProduct;
  use App\Http\Controllers\BrandProduct;
  use App\Http\Controllers\ProductController;
 use App\Http\Controllers\CartController;
 use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\VideoController;
Auth::routes();



Auth::routes();

//Danh muc san pham home
Route::get('/danh-muc/{category_id}',[CategoryProduct::class,'home_category_product']);
//Brand home
Route::get('/thuong-hieu/{brand_id}',[BrandProduct::class,'home_brand_product']);
Route::get('/chi-tiet/{product_id}',[ProductController::class,'details_product']);
//Login facebook
Route::get('/login-facebook',[AdminController::class,'login_facebook']);
Route::get('/admin/callback',[AdminController::class,'callback_facebook']);
//home

Route::get('/',[AdminController::class,'indexx']);
Route::get('/admin',[AdminController::class,'index']);
Route::post('/tim-kiem', [HomeController::class,'timkiem']);
Route::post('/tim-kiemm', [HomeController::class,'timkiemm']);
Route::get('/dashboard',[AdminController::class,'show_dashboard']);
Route::post('/admin-dashboard',[AdminController::class,'dashboard']);
Route::post('/quickview',[ProductController::class,'quickview']);



//categoryproduct
Route::get('/add-category-product',[CategoryProduct::class,'add_category_product']);
Route::get('/all-category-product',[CategoryProduct::class,'all_category_product']);
Route::get('/edit-category-product/{category_product_id}',[CategoryProduct::class,'edit_category_product']);
Route::get('/delete-category-product/{category_product_id}',[CategoryProduct::class,'delete_category_product']);
Route::post('/save-category-product',[CategoryProduct::class,'save_category_product']);
Route::post('/update-category-product/{category_product_id}',[CategoryProduct::class,'update_category_product']);

Route::get('/unactive-category-product/{category_product_id}',[CategoryProduct::class,'unactive_category_product']);
Route::get('/active-category-product/{category_product_id}',[CategoryProduct::class,'active_category_product']);

//Brand

Route::get('/add-brand-product',[BrandProduct::class,'add_brand_product']);
Route::get('/all-brand-product',[BrandProduct::class,'all_brand_product']);
Route::get('/edit-brand-product/{brand_product_id}',[BrandProduct::class,'edit_brand_product']);
Route::get('/delete-brand-product/{brand_product_id}',[BrandProduct::class,'delete_brand_product']);
Route::post('/save-brand-product',[BrandProduct::class,'save_brand_product']);
Route::post('/update-brand-product/{brand_product_id}',[BrandProduct::class,'update_brand_product']);

Route::get('/unactive-brand-product/{brand_product_id}',[BrandProduct::class,'unactive_brand_product']);
Route::get('/active-brand-product/{brand_product_id}',[BrandProduct::class,'active_brand_product']);

//Product

Route::get('/add-product',[ProductController::class,'add_product']);
Route::get('/all-product',[ProductController::class,'all_product']);
Route::get('/edit-product/{product_id}',[ProductController::class,'edit_product']);
Route::get('/delete-product/{product_id}',[ProductController::class,'delete_product']);
Route::post('/save-product',[ProductController::class,'save_product']);
Route::post('/update-product/{product_id}',[ProductController::class,'update_product']);

Route::get('/unactive-product/{product_id}',[ProductController::class,'unactive_product']);
Route::get('/active-product/{product_id}',[ProductController::class,'active_product']);

Route::resource('/product', Producttt::class);

//Cart

Route::post('/add-cart-ajax', [CartController::class,'add_cart_ajax']);
Route::get('/gio-hang',[CartController::class,'gio_hang']);
Route::get('/del-product/{session_id}',[CartController::class,'delete_product']);
Route::post('/update-cart',[CartController::class,'update_cart']);

//Checkout

Route::get('/dang-nhap',[CheckoutController::class,'login_checkout']);
Route::get('/logout-checkout',[CheckoutController::class,'logout_checkout']);
Route::post('/add-customer',[CheckoutController::class,'add_customer']);
Route::get('/checkout',[CheckoutController::class,'checkout']);
Route::post('/login-customer',[CheckoutController::class,'login_customer']);
Route::post('/save-checkout-customer',[CheckoutController::class,'save_checkout_customer']);
Route::get('/payment',[CheckoutController::class,'payment']);
Route::post('/calculate-fee',[CheckoutController::class,'calculate_fee']);
Route::post('/select-delivery-home',[CheckoutController::class,'select_delivery_home']);
Route::post('/confirm-order',[CheckoutController::class,'confirm_order']);

//Order
Route::get('/view-history-order/{order_code}',[OrderController::class,'view_history_order']);
Route::get('/history',[OrderController::class,'history']);
Route::get('/manage-order',[OrderController::class,'manage_order']);
Route::get('/view-order/{order_code}',[OrderController::class,'view_order']);
Route::get('/print-order/{order_code}',[OrderController::class,'print_order']);
Route::post('/update-order-qty',[OrderController::class,'update_order_qty']);
Route::post('/update-qty',[OrderController::class,'update_qty']);



//Coupon

Route::get('/unset-coupon',[CouponController::class,'unset_coupon']);
Route::post('/check-coupon',[CouponController::class,'check_coupon']);
Route::get('/insert-coupon',[CouponController::class,'insert_coupon']);
Route::get('/list-coupon',[CouponController::class,'list_coupon']);
Route::post('/insert-coupon-code',[CouponController::class,'insert_coupon_code']);

//Delivery
Route::get('/delivery',[DeliveryController::class,'delivery']);
Route::post('/select-delivery',[DeliveryController::class,'select_delivery']);
Route::post('/insert-delivery',[DeliveryController::class,'insert_delivery']);
Route::get('/select-feeship',[DeliveryController::class,'select_feeship']);
Route::post('/update-delivery',[DeliveryController::class,'update_delivery']);
  
//slider

Route::get('/manage-slider',[SliderController::class,'manage_slider']);
Route::get('/add-slider',[SliderController::class,'add_slider']);
Route::get('/delete-slide/{slide_id}',[SliderController::class,'delete_slide']);
Route::post('/insert-slider',[SliderController::class,'insert_slider']);
Route::get('/unactive-slide/{slide_id}',[SliderController::class,'unactive_slide']);
Route::get('/active-slide/{slide_id}',[SliderController::class,'active_slide']);

//Auth phân quyền
Route::get('/register-auth',[AuthController::class,'register_auth']);
Route::get('/login-auth',[AuthController::class,'login_auth']);
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::get('/logout-auth',[AuthController::class,'login_auth']);

//User
Route::group(['middleware' => 'auth.roles', 'auth.roles'=>['admin','author']], function () {
	Route::get('/add-product',[ProductController::class,'add_product']);
	Route::get('/edit-product/{product_id}',[ProductController::class,'edit_product']);
    Route::get('/add-brand-product',[BrandProduct::class,'add_brand_product']);
    Route::get('/edit-brand-product/{brand_product_id}',[BrandProduct::class,'edit_brand_product']);
    Route::get('/add-category-product',[CategoryProduct::class,'add_category_product']);
    Route::get('/edit-category-product/{category_product_id}',[CategoryProduct::class,'edit_category_product']);
});
Route::get('/users',[UserController::class,'index'])->middleware('auth.roles');
Route::get('/add-users',[UserController::class,'add_users'])->middleware('auth.roles');
Route::post('/store-users',[UserController::class,'store_users']);
Route::post('/assign-roles',[UserController::class,'assign_roles'])->middleware('auth.roles');

///Gallery
Route::get('/add-gallery/{product_id}',[GalleryController::class,'add_gallery']);
Route::post('/select-gallery',[GalleryController::class,'select_gallery']);
Route::post('/insert-gallery/{pro_id}',[GalleryController::class,'insert_gallery']);
Route::post('/update-gallery-name',[GalleryController::class,'update_gallery_name']);
Route::post('/delete-gallery',[GalleryController::class,'delete_gallery']);
Route::post('/update-gallery',[GalleryController::class,'update_gallery']);
//Video
Route::get('/video',[VideoController::class,'video']);
Route::get('/video-home',[VideoController::class,'video_home']);
Route::post('/select-video',[VideoController::class,'select_video']);
Route::post('/insert-video',[VideoController::class,'insert_video']);
Route::post('/update-video',[VideoController::class,'update_video']);
Route::post('/delete-video',[VideoController::class,'delete_video']);
Route::post('/update-video-img',[VideoController::class,'update_video_img']);
Route::post('/watch-video',[VideoController::class,'watch_video']);

//Thống kê
Route::post('/filter-by-date',[AdminController::class,'filter_by_date']);
Route::get('/order-date',[AdminController::class,'order_date']);
Route::post('/days-order',[AdminController::class,'days_order']);
Route::post('/dashboard-filter',[AdminController::class,'dashboard_filter']);

