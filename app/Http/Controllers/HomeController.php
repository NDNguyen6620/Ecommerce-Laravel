<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Order_detail;



class HomeController extends Controller
{
    public function index()
    {
        $category = Category::all();
        $product = Product::paginate(6)->withQueryString();
        return view('home.userpage',compact('product','category'));
    }

    public function redirect()
    {
        $usertype = Auth::user()->usertype;
        if($usertype=='1'){
            return view('admin.home');
        }else {
            return redirect()->route('home');
        }
    }
    public function product_details($id)
    {
        $product = Product::find($id);
        return view('home.product_details',compact('product'));
    }
    public function add_cart(Request $request, $id)
    {
        if(auth::id()){
            $user=Auth::user();
            $product=Product::find($id);
            $cart = new cart;
            $cart->name=$user->name;
            $cart->email=$user->email;
            $cart->phone=$user->phone;
            $cart->address=$user->address;
            $cart->user_id=$user->id;

            $cart->product_title=$product->title;
            $cart->image=$product->image;
            if($product->discount_price!=null){
                $cart->price=$product->discount_price;
            }else{
                $cart->price=$product->price;
            }
            $cart->product_id=$product->id;

            $cart->quantity=$request->quantity;
            $cart->save();

            return redirect()->back();
        }
        else{
            return redirect('login');
        }
    }
    public function show_cart()
    {
        if(auth::id()){
            $category = Category::all();
            $id=Auth::user()->id;
            $cart = Cart::where('user_id','=',$id)->get();
            return view('home.show_cart',compact('cart','category'));
        }
       else{
        return redirect('login');
       }
    }
    public function update_cart(Request $req)
    {
        $cart=Cart::find($req->cart_id);
        $cart->update( [
            'quantity' => $req->quantity,
        ]);
        return redirect()->back();
    }
    public function remove_cart($id)
    {
        $cart = Cart::find($id)->delete();
        return redirect()->back();
    }
    public function cash_order()
    {
        
        $user=Auth::user();
        $userId = $user->id;
        $data = Cart::where('user_id','=',$userId)->get();
        $order = new Order;

        $order->name = $user->name;
        $order->email = $user->email;
        $order->phone = $user->phone;
        $order->address = $user->address;
        $order->user_id = $user->id;
        $order->payment_status='cash on delivery';
        $order->deliver_status= 'processing';
        $order->save();
        foreach($data as $data){
            $order_detail = new Order_detail;
            
            $order_detail->orders_id = $order->id;
            $order_detail->product_id = $data->product_id;
            $order_detail->product_title = $data->product_title;
            $order_detail->quantity = $data->quantity;
            $order_detail->price = $data->price;
            $order_detail->image = $data->image;
            $order_detail->product_id = $data->product_id;
            $order_detail->save();
            $cart_id = $data->id;
            $cart = Cart::find($cart_id);
            $cart->delete();
        }
        
        return redirect()->back()->with('message','Order success');
    }

    public function show_order()
    {
        $category = Category::all();
        $order = Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate(5);
        return view('home.show_order',compact('category','order'));
    }
    public function show_order_detail($id)
    {
        $category = Category::all();
        $order_detail = Order_detail::where('orders_id',$id)->get();
        return view('home.show_order_detail',compact('category','order_detail'));
    }
    public function cancel($id)
    {
        $order = Order::find($id);
        $order->deliver_status = 'You cancel the order';
        return redirect()->back();
    }
    public function product_search(Request $request)
    {
        $category = Category::all();
        $search = $request->search; 
        $product = Product::where('title','LIKE',"%$search%")->orWhere('category','LIKE',"%$search%")->
        orWhere('price','LIKE',"%$search%")->orWhere('discount_price','LIKE',"%$search%")->paginate(6);
        return view('home.all_product',compact('product','category'));
    }
    public function category_search(String $name)
    {
        $category = Category::all();
        $product = Product::where('category','LIKE',"%$name%")->paginate(6);
        return view('home.cate_product',compact('product','category','name'));
    }
    public function all_product()
    {
        $category = Category::all();
        $product = Product::paginate(9)->withQueryString();
        return view('home.all_product',compact('product','category'));
    }
    public function contact()
    {
        $category = Category::all();
        return view('home.contact',compact('category'));
    }
}
