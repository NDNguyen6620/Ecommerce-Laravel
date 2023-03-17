<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
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
                        <h1 class="font_size">Add Category</h1>
                        <form action="{{url('/add_product')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="div_design">
                                <label for="">Product Title:</label>
                                <input type="text" class="text_color" name="title" placeholder="write title product" required>
                            </div>
                            <div class="div_design">
                                <label for="">Product Description:</label>
                                <input type="text" class="text_color" name="description" placeholder="write description product" required>
                            </div>
                            
                            <div class="div_design">
                                <label for="">Product Price:</label>
                                <input type="text" class="text_color" name="price" placeholder="write price product" required>
                            </div>
                            <div class="div_design">
                                <label for="">Product Quantity:</label>
                                <input type="text" class="text_color" name="quantity" min="0" placeholder="write quantity product" required>
                            </div>
                            <div class="div_design">
                                <label for="">Product Discount Price:</label>
                                <input type="text" class="text_color" name="discount_price" placeholder="write discount price product">
                            </div >
                            <div class="div_design">
                                <label for="">Product Category:</label>
                                <select name="category" id="" class="text_color">
                                    <option value="" selected="">Add a category here</option>
                                    @foreach($category as $value)
                                    <option value="{{$value->category_name}}">{{$value->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="div_design">
                                <label for="">Product Image:</label>
                                <input type="file" name="file" required>
                            </div>
                            <div >
                                <input type="submit" value="Add Product" class="btn btn-primary">
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