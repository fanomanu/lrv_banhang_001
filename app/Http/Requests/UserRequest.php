<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'txtUser' 	  => 'required|unique:users,username',
			'txtPass'	  => 'required',	
			'txtRePass'	  => 'required|same:txtPass',
			'txtEmail'	  =>  'required|regex:/^[a-z][a-z0-9]*(_[a-z0-9]+)*(\.[a-z0-9]+)*@[a-z0-9]([a-z0-9][a-z0-9]+)*(\.[a-z]{2,4}){1,2}$/'
		];
	}

	public function messages(){
		return[
			'txtUser.required'	=> 'Xin vui lòng nhập Username',
			'txtUser.unique'	=> 'Username đã tồn tại',
			'txtPass.required'	=> 'Xin vui lòng nhập Password',
			'txtRePass.required'=> 'Xin vui lòng nhập lại Password',
			'txtRePass.same'	=> 'Password nhập lại không đúng',
			'txtEmail.required'	=> 'Xin vui lòng nhập email',
			'txtEmail.regex'	=> 'Email nhập không đúng'
		];
	}
}
