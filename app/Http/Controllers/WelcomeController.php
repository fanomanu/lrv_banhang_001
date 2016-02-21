<?php namespace App\Http\Controllers;
use Request;
use DB,Mail;
use Gloudemans\Shoppingcart\Facades\Cart;


class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$product = DB::table('products')->select('id','name','image','price','alias')->orderBy('id','DESC')->skip(0)->take(4)->get();
		return view('user.pages.home',compact('product'));
	}

	public function loaisanpham($id){
		$product_cate = DB::table('products')->select('id','name','image','price','alias','category_id')->where('category_id',$id)->paginate(3); 
		$cate = DB::table('categories')->select('parent_id')->where('id',$id)->first();
		$cate_menu = DB::table('categories')->select('id','name','alias')->where('parent_id',$cate->parent_id)->get();
		//print_r($cate_menu);
		return view('user.pages.category',compact('product_cate','cate_menu'));
	}

	public function chitietsanpham($id){
		$product_detail = DB::table('products')->where('id',$id)->first();
		$image = DB::table('product_images')->select('id','image')->where('product_id',$id)->get();
		$rel_product = DB::table('products')->select('id','name','price','image','alias')->where('category_id',$product_detail->category_id)->where('id','<>',$id)->take(4)->get();
		return view('user.pages.product_detail',compact('product_detail','image','rel_product'));
	}

	public function getLienhe(){
		return view('user.pages.contact');
	}

	public function postLienhe(Request $request){
		$data = ['hoten' => $request->name,'tinnhan' => $request->message];
		Mail::send('emails.blank',$data,function($message){
			$message->from('benfriends20071988@gmail.com');
			$message->to('benfriends20071988@gmail.com')->subject('Thừ từ trang web.');
		});
		echo "<script>
			alert('Cám ơn bạn đã góp ý. Chúng tôi sẽ liên lạc trong thời gian sớm nhất.');
			window.location = '".url('/')."'
		</script>";
	}

	public function muahang($id){
		$product_buy = DB::table('products')->where('id',$id)->first();
		$arr_cart = array('id'=>$id,'name'=>$product_buy->name,'qty'=>1,'price'=>$product_buy->price,'options'=>array('image' => $product_buy->image));
		//print_r($arr_cart);
		Cart::add($arr_cart);
		$content = Cart::content();
		print_r($content);
		return redirect()->route('giohang');
	}

	public function giohang(){
		$content = Cart::content();
		$total = Cart::total();
		return view('user.pages.shopping-cart',compact('content','total'));
	}

	public function xoaspgiohang($id){
		Cart::remove($id);
		return redirect()->route('giohang');
	}

	public function capnhatgiohang(){
		if(Request::ajax()){
			$id 	= Request::get('id');
			$qty	= Request::get('qty');
			Cart::update($id,$qty);
			echo '2788';
		}
	}
}
