<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\Order_detail;

use PDF;




class AdminController extends Controller
{
    // category_funtion
    public function view_category()
    {   
        $category = Category::all();
        return view('admin.category',compact('category'));
    }
    public function add_category(Request $request)
    {
        $category = Category::create($request->all());
        return redirect()->back()->with('message','Category added successfully');
    }
    public function delete_category($id)
    {
        $category = Category::find($id)->delete();
        return redirect()->back()->with('message','Category deleted successfully');
    }

    // product_funtion
    public function view_product()
    {   
        $category = Category::all(); 
        $product = Product::all();
        return view('admin.product',compact('product','category'));
    }
    public function add_product(Request $request)
    {
            if($request->hasFile('file')){
                $file = $request->file;
                $file_name = $file->getClientOriginalName();
                $file->move(public_path('product_image'),$file_name);
            }else{
                $file_name= $product->image;
            }
            $request->merge(['image'=>$file_name]);
            try {
                Product::create($request->all());
                return redirect()->back()->with('message','Product added successfully');
            } catch (\Throwable $th) {
                dd($th);
            }
    }
    public function show_product()
    {
        $product = Product::paginate(6)->withQueryString();
        return view('admin.show_product',compact('product'));    
    }
    public function delete_product($id)
    {
        $product = Product::find($id)->delete();
        return redirect()->back()->with('message','Product deleted successfully');
    }
    public function update_product($id)
    {   
        $product = Product::find($id);
        $category = Category::all();
        return view('admin.update_product',compact('product','category'));
        
    }
    public function update_product_confirm(Request $request,$id)
    {
        $product = Product::find($id);
        if($request->hasFile('file')){
            $file = $request->file;
            $file_name = $file->getClientOriginalName();
            $file->move(public_path('product_image'),$file_name);
        }else{
            $file_name= $product->image;
        }
        $request->merge(['image'=>$file_name]);
        try {
            $product->update($request->all());
            return redirect()->back()->with('message','Product update successfully');
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    
    public function show_orders()
    {
        $order = Order::all();
        return view('admin.orders',compact('order'));
    }


    public function show_order_detail($id)
    {
        $order_detail = Order_detail::where('orders_id','=',$id)->get();
        return view('admin.order_detail',compact('order_detail'));
    }
    public function delivered($id)
    {
        $order = Order::find($id);
        $order->deliver_status = "Delivered";
        $order->payment_status = "Paid";

        $order->save();
        return redirect()->back();
    }
    public function print_pdf($id)
    {
        $order = Order::find($id);
        $order_detail = Order_detail::where('orders_id','=',$id)->get();
        $pdf=PDF::loadview('admin.pdf',compact('order','order_detail'));
        return $pdf->download('order_detail.pdf');
    }
    public function search(Request $request)
    {
        $search = $request->search;
        $order = Order::where('name','LIKE',"%$search%")->orWhere('email','LIKE',"%$search%")->
        orWhere('phone','LIKE',"%$search%")->get();
        return view('admin.orders',compact('order'));
    }
    public function search2(Request $request)
    {
        $search = $request->search2;    
        $product = Product::where('title','LIKE',"%$search%")->orWhere('category','LIKE',"%$search%")->
        orWhere('price','LIKE',"%$search%")->orWhere('quantity','LIKE',"%$search%")->
        orWhere('discount_price','LIKE',"%$search%")->paginate(5);
        return view('admin.show_product',compact('product'));
    }
}
