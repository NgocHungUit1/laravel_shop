<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeShip extends Model
{
    use HasFactory;

    public $timestamps = false; //set time to false
    protected $fillable = [
    	'matp', 'maqh','xaid','fee_feeship'
    ];
    protected $primaryKey = 'fee_id';
 	protected $table = 'tbl_feeship';
	public function city(){
 		return $this->belongsTo('App\Models\City','matp');
 	}
 
 	public function province(){
 		return $this->belongsTo('App\Models\Province','maqh');
 	}
 	public function wards(){
 		return $this->belongsTo('App\Models\Wards','xaid');
 	}
}
