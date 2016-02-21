<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProductRequest extends Request {

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
			'slParent' 	=> 'required',
			'txtName' 	=> 'required|unique:products,name',
			'txtPrice'	=> 'required',
			'fImages'	=> 'required|image'
 		];
	}

	public function messages(){
		return [
			'slParent.required'		=> 'Xin vui lòng nhập loại.',
			'txtName.required'		=> 'Xin vui lòng nhập tên.',
			'txtName.unique'		=> 'Tên này đã tồn tại.',
			'txtPrice.required'		=> 'Xin vui lòng nhập giá.',
			'fImages.required'		=> 'Xin vui lòng chọn ảnh đại diện',
			'fImages.image'			=> 'File bạn nhập không phải là hình'
		];
	}

}
