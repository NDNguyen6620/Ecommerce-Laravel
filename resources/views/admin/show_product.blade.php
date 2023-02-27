<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->

    @include('admin/css')
    <style type="text/css">
        .center{
            width:50%;
            margin:auto;
            border:2px solid white;
            margin-top:40px; 
        }
        .font_size{
            text-align:center;
            font-size:40px;
            padding-top:20px;
        }
        .img_size{
            width: 100px !important;
            height:100px !important;
            border-radius:10px !important;
        }
        .th_color{
            background:#fff;
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
                <h2 class="font_size">All Products</h2>
                    <table class="table center">
                        <thead>
                            <tr class="th_color">
                                <th>Product title</th>
                                <th>Description</th>
                                <th>Quantity</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Discount Price</th>
                                <th>Product Image</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($product as $data)
                            <tr>
                                <td scope="row">{{$data->title}}</td>
                                <td>{{$data->description}}</td>
                                <td>{{$data->quantity}}</td>
                                <td>{{$data->category}}</td>
                                <td>{{$data->price}}</td>
                                <td>{{$data->discount_price}}</td>
                                <td>
                                    <img class="img_size" src="/product_image/{{$data->image}}" alt="">
                                </td>
                                <td>
                                    <a href="{{url('/update_product',$data->id)}}" class="btn btn-success">Edit</a>
                                </td>
                                <td><a onclick="return confirm('Are you sure to delete this product?')" href="{{url('/delete_product',$data->id)}}" class="btn btn-danger">Delete</a></td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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