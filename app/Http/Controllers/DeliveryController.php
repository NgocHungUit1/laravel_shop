<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\City;
use App\Models\Province;
use App\Models\Wards;
use App\Models\Feeship;

session_start();

class DeliveryController extends Controller
{
    public function update_delivery(Request $request){
		$data = $request->all();
		$fee_ship = Feeship::find($data['feeship_id']);
		$fee_value = rtrim($data['fee_value'],'.');
		$fee_ship->fee_feeship = $fee_value;
		$fee_ship->save();
	}

   public function select_feeship(){
		$feeship = Feeship::with('city','province','wards')->orderby('fee_id','DESC')->get();
		return view('admin.delivery.text')->with(compact('feeship'));


		
	}
	public function insert_delivery(Request $request){
		$data = $request->all();
		$fee_ship = new Feeship();
		$fee_ship->matp = $data['city'];
		$fee_ship->maqh = $data['province'];
		$fee_ship->xaid = $data['wards'];
		$fee_ship->fee_feeship = $data['fee_ship'];
		$fee_ship->save();
	}
    public function delivery(Request $request){

    	$city = City::orderby('matp','ASC')->get();

    	return view('admin.delivery.add_delivery')->with(compact('city'));
    }
    public function select_delivery(Request $request){
    	$data = $request->all();
    	if($data['action']){
    		$output = '';
    		if($data['action']=="city"){
    			$select_province = Province::where('matp',$data['ma_id'])->orderby('maqh','ASC')->get();
    				$output.='<option>---Chọn quận huyện---</option>';
    			foreach($select_province as $key => $province){
    				$output.='<option value="'.$province->maqh.'">'.$province->name_quanhuyen.'</option>';
    			}

    		}else{

    			$select_wards = Wards::where('maqh',$data['ma_id'])->orderby('xaid','ASC')->get();
    			$output.='<option>---Chọn xã phường---</option>';
    			foreach($select_wards as $key => $ward){
    				$output.='<option value="'.$ward->xaid.'">'.$ward->name_xaphuong.'</option>';
    			}
    		}
    		echo $output;
    	}
    	
    }
}
