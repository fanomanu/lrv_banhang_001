<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests\UserRequest;
use App\User;
use Hash;
use Auth;

class UserController extends Controller {

	//-----------------
	//-----LIST
	//-----------------
	public function getList(){
		$users = User::select('id','username','level')->orderBy('id','DESC')->get()->toArray();
		return view('admin.user.list',compact('users'));
	}

	//-----------------
	//-----ADD
	//-----------------
	public function getAdd(){
		return view('admin.user.add');
	}

	public function postAdd(UserRequest $request){
		$nUser = new User;
		$nUser->username 			= $request->txtUser;
		$nUser->password 			= Hash::make($request->txtPass);
		$nUser->email 				= $request->txtEmail;
		$nUser->level 				= $request->rdoLevel;
		$nUser->remember_token 		= $request->_token;
		$nUser->save();
		return redirect()->route('admin.user.list')->with(['flash-type'=>'alert-success','flash-message'=>'Đã thêm user thành công.']);	
	}


	//-----------------
	//-----DELETE
	//-----------------
	public function getDelete($id){
		$user_current_login	= Auth::user()->id;
		$user 	= User::find($id);
		if($user->id == 1 || ($user_current_login != 1 && $user['level'] == 1)){
			return redirect()->route('admin.user.list')->with(['flash-type'=>'alert-danger','flash-message'=>'Bạn không thể xóa username bằng hoặc hơn cấp.']);
		}else{
			$user->delete($id);
			return redirect()->route('admin.user.list')->with(['flash-type'=>'alert-success','flash-message'=>'Đã xóa thành công user']);
		}
	}

	//-----------------
	//-----Edit
	//-----------------
	public function getEdit($id){
		$user = User::find($id);
		if((Auth::user()->id != 1) && ($id == 1 || ($user['level'] == 1 && Auth::user()->id != $id))){
			return redirect()->route('admin.user.list')->with(['flash-type'=>'alert-danger','flash-message'=>'Bạn không thể sửa thông tin.']);
		}
		return view('admin.user.edit',compact('user'));
	}

	public function postEdit($id,Request $request){
		$eUser = User::find($id);
		if($request->input('txtPass')){
			$this->validate($request,
				[
					'txtPass' => 'same:txtRePass'
				],[
					'txtPass.same' => 'Password nhập vào không trùng nhau.'
				]);
			$eUser->password = Hash::make($request->txtPass);
		}
		$eUser->email = $request->txtEmail;
		$eUser->level = $request->rdoLevel;
		$eUser->remember_token = $request->_token;
		$eUser->save();
		return redirect()->route('admin.user.list')->with(['flash-type'=>'alert-success','flash-message'=>'Đã sửa thành công thông tin user']);
	}
}
