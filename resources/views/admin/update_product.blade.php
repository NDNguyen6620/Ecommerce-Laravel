<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <base href="/product">
    @include('admin/css')
    <style type="text/css">
        .div_center{
            text-align: center;
            padding-top: 40px;
        }
        .font_size{
            font-size:40px;
            padding-bottom: 40px;
        }
        .text_color{
          color: black;
          padding-bottom:20px;
        }
        label{
            display:inline-block;
            width: 200px ;
        }
        .div_design{
            padding-bottom:15px;
        }
    </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin/sidebar')
      <!-- partial -->
      <!-- partial:partials/_navbar.html -->
      @include('admin/header')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                @if(session()->has('message'))
                    <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        {{session()->get('message')}}
                    </div>

                @endif
                <div class="div_center">
                        <h1 class="font_size">Update Category</h1>
                        <form action="{{url('/update_product_confirm',$product->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="div_design">
                                <label for="">Product Title:</label>
                                <input type="text" class="text_color" name="title" placeholder="write title product" value="{{$product->title}}" required>
                            </div>
                            <div class="div_design">
                                <label for="">Product Description:</label>
                                <input type="text" class="text_color" name="description" placeholder="write description product" value="{{$product->description}}" required>
                            </div>
                            
                            <div class="div_design">
                                <label for="">Product Price:</label>
                                <input type="text" class="text_color" name="price" placeholder="write price product" value="{{$product->price}}" required>
                            </div>
                            <div class="div_design">
                                <label for="">Product Quantity:</label>
                                <input type="text" class="text_color" name="quantity" min="0" placeholder="write quantity product" value="{{$product->quantity}}" required>
                            </div>
                            <div class="div_design">
                                <label for="">Product Discount Price:</label>
                                <input type="text" class="text_color" name="discount_price" placeholder="write discount price product" value="{{$product->discount_price}}" required>
                            </div >
                            <div class="div_design">
                                <label for="">Product Category:</label>
                                <select name="category_id" id="" class="text_color">
                                    @foreach($category as $value)
                                    <option value="{{$value->id}}" {{$value->id == $product->category_id ? 'selected' : ''}}>
                                    {{$value->category_name}}</option>                                    
                                    @endforeach
                                </select>
                            </div>
                            <div class="div_design">
                                <label for="">Current Product Image:</label>
                                
                                <img style="margin:auto;" height="100px" width="100px" src="/product_image/{{$product->image}}" alt="">
                            </div>
                            
                            <div class="div_design">
                                <label for="">Product Image:</label>
                                
                                <input type="file" name="file">
                            </div>
                            <div >
                                <input type="submit" value="Update Product" class="btn btn-primary">
                            </div>
                        </form>
                        
                       
                        
                </div>
            </div>
        </div>
        
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin/script')
    <!-- End custom js for this page -->
  </body>
</html>