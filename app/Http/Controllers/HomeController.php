<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;


class HomeController extends Controller
{
    public function index()
    {
        $product = Product::all();
        return view('home.userpage',compact('product'));
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
            $id=Auth::user()->id;
            $cart = Cart::where('user_id','=',$id)->get();
            return view('home.show_cart',compact('cart'));
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
        foreach($data as $data){
            $order = new Order;

            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->user_id = $data->user_id;
            $order->product_title = $data->product_title;
            $order->price = $data->price;
            $order->quantity = $data->quantity;
            $order->image = $data->image;
            $order->product_id = $data->product_id;
            $order->payment_status='cash on delivery';
            $order->deliver_status= 'processing';
            $order->save();

            $cart_id = $data->id;
            $cart = Cart::find($cart_id);
            $cart->delete();

        }
        return redirect()->back()->with('message','Order success');
    }
}
