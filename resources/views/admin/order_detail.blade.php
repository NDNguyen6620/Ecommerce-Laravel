<!DOCTYPE html>
<html lang="en">
  <head>
  <base href="/product">
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
        .font_size2{
            text-align:center;
            font-size:25px;
            padding-top:20px;
        }
        .th_color{
            background:#fff;
        }
        th{
            border:1px solid black;
        }
        td{
            border:1px solid white;

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
                <h2 class="font_size">Order Detail</h2>
                    <table class="table center" style="border:2px solid white;">
                        <thead>
                            <tr class="th_color">
                                <th>Product Title</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Image</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $totalPrice = 0; ?>
                            @foreach($order_detail as $data)
                            <tr>
                                <td scope="row">{{$data->product_title}}</td>
                                <td>{{$data->quantity}}</td>
                                <td>{{$data->price * $data->quantity}}</td>
                                <td>
                                    <img src="/product_image/{{$data->image}}" alt="">
                                </td>                           
                            </tr>
                            <?php $totalPrice = $totalPrice + ($data->price * $data->quantity) ?>
                            @endforeach
                        </tbody>
                    </table>
                    <h4 class="font_size2">Total Price: {{$totalPrice}}</h4>
                    
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