<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Social;
use App\Models\Visitor;
use App\Models\Product;
use App\Models\Video;
use App\Models\Category;
use App\Models\SLider;
use DB;
use App\Models\Brand;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Session;
use Socialite;
use Carbon\Carbon;
use App\Models\Statistic;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin_login');
    }
    public function AuthLogin()
    {
        $admin_id = Auth::id();
        if ($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }


    

    public function login_facebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback_facebook()
    {
        $provider = Socialite::driver('facebook')->user();
        $account = Social::where('provider', 'facebook')->where('provider_user_id', $provider->getId())->first();
        if ($account) {
            //login in vao trang quan tri
            $account_name = Admin::where('admin_id', $account->user)->first();
            Session::put('admin_name', $account_name->admin_name);
            Session::put('admin_id', $account_name->admin_id);
            return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');
        } else {

            $hieu = new Social([
                'provider_user_id' => $provider->getId(),
                'provider' => 'facebook',
            ]);

            $orang = Admin::where('admin_email', $provider->getEmail())->first();

            if (!$orang) {
                $orang = Admin::create([
                    'admin_name' => $provider->getName(),
                    'admin_email' => $provider->getEmail(),
                    'admin_password' => '',
                    'admin_phone' => '',

                ]);
            }
            $hieu->login()->associate($orang);
            $hieu->save();

            $account_name = Admin::where('admin_id', $account->user)->first();
            Session::put('admin_name', $account_name->admin_name);
            Session::put('admin_id', $account_name->admin_id);
            return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');
        }
    }
    public function dashboard(Request $request)
    {
        $data = $request->validate([
            //validation laravel
            'admin_email' => 'required',
            'admin_password' => 'required',

        ]);

        $admin_email = $data['admin_email'];
        $admin_password = md5($data['admin_password']);
        $login = Admin::where('admin_email', $admin_email)->where('admin_password', $admin_password)->first();
        if ($login) {
            $login_count = $login->count();
            if ($login_count > 0) {
                Session::put('admin_name', $login->admin_name);
                Session::put('admin_id', $login->admin_id);
                return Redirect::to('/dashboard');
            }
        } else {
            Session::put('message', 'Mật khẩu hoặc tài khoản bị sai.Làm ơn nhập lại');
            return Redirect::to('/dashboard');
        }
    }
    public function filter_by_date(Request $request)
    {
        $data = $request->all();
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];
        $get = Statistic::whereBetween('order_date', [$from_date, $to_date])->orderBy('order_date', 'ASC')->get();
        foreach ($get as $key => $val) {
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity


            );
        }
        echo $data = json_encode($chart_data);
    }
    public function show_dashboard(Request $request)
    {
        $this->AuthLogin();
        $user_ip_address=$request->ip();
        $dauthangnay=Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $dauthangtruoc=Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $cuoithangtruoc=Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
        $sub7days=Carbon::now('Asia/Ho_Chi_Minh')->subDays(7)->toDateString();
        $oneyear=Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->toDateString();
        $now=Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        //total last month
        $visitor_lastmonth=Visitor::whereBetween('date_visitor',[$dauthangtruoc,$cuoithangtruoc])->get();
        $visitor_lastmonth_count=$visitor_lastmonth->count();
         //total this month
        $visitor_thismonth=Visitor::whereBetween('date_visitor',[$dauthangnay,$now])->get();
        $visitor_thismonth_count=$visitor_thismonth->count();
          //total this on years
        $visitor_thisyear=Visitor::whereBetween('date_visitor',[$oneyear,$now])->get();
        $visitor_thisyear_count=$visitor_thisyear->count();
         //current online
        $visitor_current=Visitor::where('ip_address',$user_ip_address)->get();
        $visitor_count=$visitor_current->count();
        if($visitor_count<1){
            $visitor=new Visitor();
            $visitor->ip_address=$user_ip_address;
            $visitor->date_visitor=Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
            $visitor->save();
        }
        //total visitor
        $visitor=Visitor::all();
        $visitor_total=$visitor->count();
        //total donut
        $product=Product::all()->count();
        $product_views=Product::orderBy('product_views','Desc')->take(20)->get();
        $order=Order::all()->count();
        $videoo=Video::all()->count();
        $customer=Customer::all()->count();


        return view('admin.dashboard')->with(compact('visitor_total','visitor_count','visitor_thisyear_count','visitor_thismonth_count','visitor_lastmonth_count','product','order','customer','videoo','product_views'));
    }
    public function dashboard_filter(Request $request)
    {
        $data = $request->all();
        $dauthangnay=Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $dauthangtruoc=Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $cuoithangtruoc=Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
        $sub7days=Carbon::now('Asia/Ho_Chi_Minh')->subDays(7)->toDateString();
        $sub365days=Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->toDateString();
        $now=Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        if($data['dashboard_value']=='7ngay'){
            $get=Statistic::whereBetween('order_date',[$sub7days,$now])->orderBy('order_date','ASC')->get();
        }elseif($data['dashboard_value']=='thangtruoc'){
            $get=Statistic::whereBetween('order_date',[$dauthangtruoc,$cuoithangtruoc])->orderBy('order_date','ASC')->get();
        }elseif($data['dashboard_value']=='thangnay'){
            $get=Statistic::whereBetween('order_date',[$dauthangnay,$now])->orderBy('order_date','ASC')->get();
        }else{
            $get=Statistic::whereBetween('order_date',[$sub365days,$now])->orderBy('order_date','ASC')->get();
        }
        foreach ($get as $key => $val) {
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity


            );
        }
        echo $data = json_encode($chart_data);
    }
    public function days_order(){
        $sub30days=Carbon::now('Asia/Ho_Chi_Minh')->subDays(60)->toDateString();
        $now=Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
         $get=Statistic::whereBetween('order_date',[$sub30days,$now])->orderBy('order_date','ASC')->get();
         foreach ($get as $key => $val) {
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity


            );
        }
        echo $data = json_encode($chart_data);
    }
    public function indexx()
    {
         $cate = Category::orderBy('category_id','desc')->where('category_status','0')->get();
         $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();
     $all= DB::table('tbl_category_product')
        ->join('tbl_product','tbl_product.category_id','=','tbl_category_product.category_id')        
        ->orderby('tbl_category_product.category_id','desc')->get();

      $brand =Brand::orderBy('brand_id','desc')->where('brand_status','0')->get();
      $all_product=Product::orderBy('product_id','desc')->where('product_status','0')->paginate(6);
        return view('pages.home')->with(compact('cate','brand','all_product','all','slider'));

       
    }

}
