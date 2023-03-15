<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <base href="/public">
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="images/favicon.png" type="">
      <title>Famms - Fashion HTML Template</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="home/css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="home/css/style.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="home/css/responsive.css" rel="stylesheet" />
      <style type="text/css">
            .center{
                margin:auto;
                width: 50%;
                text-align:center;
            }
            table,th,td{
                border: 1px solid black;
            }
            .total_deg{
               font-size:20px;
               padding:20px;
               margin: auto;
            }
      </style>
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
         @include('home.header')
         <!-- end header section -->
         <!-- end slider section -->
      <!-- why section -->

      @if(session()->has('message'))
                    <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        {{session()->get('message')}}
                    </div>

      @endif

     <table class="table center">
        <thead>
            <tr>
               
                <th>Product title</th>
                <th>Product quantity</th>
                <th>Price</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        
            <?php $totalPrice = 0; ?>
            @foreach($cart as $data)
            <form action="{{url('update_cart')}}" method="post">
            @csrf
            <tr>
               <input type="hidden" name="cart_id" value="{{$data->id}}">
                <td scope="row">{{$data->product_title}}</td>
                <td>
                   <input type="number" name="quantity" value="{{$data->quantity}}" min="1" style="width:70px; height:30px;"> 
                </td>
                <td>{{$data->price * $data->quantity}}
                </td>
                <td><img src="product_image/{{$data->image}}" alt="" width="30px" class="m-auto"></td>
                <td >
                  <button onclick="return confirm('Are you sure to update this product?')"  class="btn btn-primary">update</button>

                  <a onclick="return confirm('Are you sure to remove this product?')" href="{{url('remove_cart',$data->id)}}" class="btn btn-danger">Remove</a>
               </td>
            </tr>
            <?php $totalPrice = $totalPrice + ($data->price * $data->quantity) ?>
            </form>
            @endforeach
            
        </tbody>
     </table>
     <div>
            <h1 class="total_deg center">Total Price: {{$totalPrice}}</h1>
     </div>
     <div class="center " > 
            <h1 class="total_deg" >Proceed to order</h1>
            <a  href="{{url('cash_order')}}" class="btn btn-danger">Cash On Delivery</a>
            <a  href="" class="btn btn-danger">Pay Using Car</a>
     </div>
      <!-- end client section -->
      <!-- footer start -->
     
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
         </p>
      </div>
      <!-- jQery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>
   </body>
</html>