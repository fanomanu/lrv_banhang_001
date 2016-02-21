<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

Use App\Category;
Use App\Product;
Use App\Product_image;
use App\Http\Requests\ProductRequest;
use Input,File;

use Auth;

class ProductController extends Controller {

	//-----------------
	//-----LIST
	//-----------------
	public function getList(){
		$data = Product::select('id','name','price','category_id','created_at')->orderBy('id','DESC')->get()->toArray();
		return view('admin.product.list',compact('data'));
	}

	//-----------------
	//-----ADD
	//-----------------
	public function getAdd(){
		$cate = Category::select('name','id','parent_id')->get()->toArray();
		return view('admin.product.add',compact('cate'));
	}

	public function postAdd(ProductRequest $request){
		$file_name = $request->file('fImages')->getClientOriginalName();

		$nProd	= new Product;
		$nProd->name = $request->txtName;
		$nProd->alias = changeTitle($request->txtName);
		$nProd->price = $request->txtPrice;
		$nProd->intro = $request->txtIntro;
		$nProd->content = $request->txtContent;
		$nProd->image = $file_name;
		$nProd->keywords = $request->txtKeywords;
		$nProd->description = $request->txtDescription;
		$nProd->user_id = auth::user()->id;
		$nProd->category_id = $request->slParent;
		$nProd->save();
		$request->file('fImages')->move('resources/upload/',$file_name);

		$nProdID = $nProd->id;
		if(input::hasFile('fProductDetail')){
			//print_r(input::file('fProductDetail'));
			foreach (input::file('fProductDetail') as $file) {
				$product_img = new Product_image();
				if(isset($file)){
					$product_img->image = $file->getClientOriginalName();
					$product_img->product_id = $nProdID;
					$file->move('resources/upload/detail/',$file->getClientOriginalName());
					$product_img->save();
				}
			}
		}
		return redirect()->route('admin.product.list')->with(['flash-type'=>'alert-success','flash-message'=>'Đã thêm sản phẩm thành công.']);	
	}

	//-----------------
	//-----DELETE
	//-----------------
	public function getDelete($id){
		$product_detail = Product::find($id)->pImage->toArray();
		// Xóa hình detail
		foreach ($product_detail as $value) {
			File::delete('resources/upload/detail/'.$value['image']);
			$product_img = Product_image::find($value['id']);
			$product_img->delete();
		}
		// Xóa hình 		
		$xProd = Product::find($id);
		File::delete('resources/upload/'.$xProd->image);
		$xProd->delete();
		return redirect()->route('admin.product.list')->with(['flash-type'=>'alert-success','flash-message'=>'Đã xóa thành công sản phẩm.']);
		//print_r($product_detail);
	}

	//-----------------
	//-----EDIT
	//-----------------
	public function getEdit($id){
		$cate = Category::select('name','id','parent_id')->get()->toArray();
		$product 		= Product::find($id)->toArray();
		$product_image 	= Product::find($id)->pimage()->get()->toArray();
		//print_r($product_image);
		return view('admin.product.edit',compact('cate','product','product_image'));
	}

	public function postEdit(Request $request,$id){
		//print_r($request->file('fEditImage'));
		
		$eProd = Product::find($id);
		$eProd->name = $request->txtName;
		$eProd->alias = changeTitle($request->txtName);
		$eProd->price = $request->txtPrice;
		$eProd->intro = $request->txtIntro;
		$eProd->content = $request->txtContent;
		$eProd->keywords = $request->txtKeywords;
		$eProd->description = $request->txtDescription;
		$eProd->user_id = auth::user()->id;
		$eProd->category_id = $request->slParent;
		if(!empty($request->file('fImage'))){
			$l_old_image	= 'resources/upload/'.$eProd->image;
			$n_image 		= $request->file('fImage');
			//echo $n_image->getClientOriginalName();
			$eProd->image 	= $n_image->getClientOriginalName();
			$n_image->move('resources/upload/',$n_image->getClientOriginalName());
			if(File::exists($l_old_image)){
				File::delete($l_old_image);
			}else{

			}
			//echo $l_old_image;
		}else{
			
		}	
		if(!empty($request->file('fEditImage'))){
			foreach (input::file('fEditImage') as $file) {
				$product_img = new Product_image();
				if(isset($file)){
					$product_img->image = $file->getClientOriginalName();
					$product_img->product_id = $id;
					$file->move('resources/upload/detail/',$file->getClientOriginalName());
					$product_img->save();
				}
			}	
		}
		$eProd->save();
		return redirect()->route('admin.product.list')->with(['flash-type'=>'alert-success','flash-message'=>'Đã sửa thành công sản phẩm.']);
	}

	//-----------------
	//-----EDIT IMAGE DETAIL
	//-----------------
	public function getDelImg($id){
		if(request::ajax()){
			$idHinh  	= (int)request::get('idHinh');
			$img_detail = Product_image::find($idHinh);
			if(!empty($img_detail)){
				$img = 'resources/upload/detail/'.$img_detail->image;
				if(File::exists($img)){
					File::delete($img);
				}
				$img_detail->delete();
				return "2788";
			}
		}
	}
}
