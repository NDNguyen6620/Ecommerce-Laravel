<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Product;


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
        $product = Product::all();
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
}
