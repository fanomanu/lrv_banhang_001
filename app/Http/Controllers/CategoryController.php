<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Category;

class CategoryController extends Controller {

	public function getList(){
		$data = Category::select('id','name','parent_id')->orderBy('id','DESC')->get()->toArray();
		return view('admin.category.list',compact('data'));
	}

	public function getAdd(){
		$parent = Category::select('id','name','parent_id')->get()->toArray();
		return view('admin.category.add',compact('parent'));
	}

	public function postAdd(CategoryRequest $request){
		$ncategory 				= new Category;
		$ncategory->name 		=  	$request->txtCateName;
		$ncategory->alias 		=  	changeTitle($request->txtCateName);
		$ncategory->order 		=	$request->txtOrder;
		$ncategory->parent_id 	=	$request->slParent;
		$ncategory->keywords 	=	$request->txtKeywords;	
		$ncategory->description =	$request->txtDescription;
		$ncategory->save();
		return redirect()->route('admin.category.list')->with(['flash-type'=>'alert-success','flash-message'=>'Đã thêm loại thành công']);
	}	

	public function getDelete($id){
		$child_num = category::where('parent_id',$id)->count();
		if($child_num == 0){
			$cate = Category::find($id);
			$cate->delete();
			return redirect()->route('admin.category.list')->with(['flash-type'=>'alert-success','flash-message'=>'Đã xóa xong loại']);	
		}else{
			echo "<script type='text/javascript'>
			alert('Xin lỗi bạn không thể xóa loại này.');
			window.location = '";
			echo route('admin.category.list');
			echo "'
			</script>";
		}
	}

	public function getEdit($id){
		$eCate 	= Category::findOrFail($id)->toArray();

		$parent = Category::select('id','name','parent_id')->get()->toArray();
		return view('admin.category.edit',compact('parent','eCate','id'));
	}

	public function postEdit(Request $request,$id){
		//echo $request;
		$this->validate($request,
			['txtCateName' => 'required'], 
			['txtCateName.required' => 'Xin vui lòng nhập tên.']
		);
		$pCate = Category::find($id);
		$pCate->name 		=  	$request->txtCateName;
		$pCate->alias 		=  	changeTitle($request->txtCateName);
		$pCate->order 		=	$request->txtOrder;
		$pCate->parent_id 	=	$request->slParent;
		$pCate->keywords 	=	$request->txtKeywords;	
		$pCate->description =	$request->txtDescription;
		$pCate->save();
		return redirect()->route('admin.category.list')->with(['flash-type'=>'alert-success','flash-message'=>'Đã sửa thông tin loại thành công']);
	}
}
