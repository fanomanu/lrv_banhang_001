<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

	protected	$table 		= 'products';

	protected 	$fillable 	= ['alias','price','intro','content','image','keywords','description','user_id','category_id'];

	public 		$timestamps = true;

	public function category(){
		return $this->belongsTo('App\Category');
	}

	public function user(){
		return $this->belongsTo('App\User');
	}

	public function pimage(){
		return $this->hasMany('App\Product_image');
	}
}
