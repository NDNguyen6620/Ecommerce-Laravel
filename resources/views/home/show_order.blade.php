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
         <header class="header_section">
            <div class="container">
               <nav class="navbar navbar-expand-lg custom_nav-container ">
                  <a class="navbar-brand" href="{{url('/')}}"><img width="250" src="images/logo.png" alt="#" /></a>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class=""> </span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                     <ul class="navbar-nav">
                        <li class="nav-item ">
                           <a class="nav-link" href="{{url('/')}}">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item dropdown ">
                           <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"> <span class="nav-label">Products <span class="caret"></span></a>
                           <ul class="dropdown-menu">
                              @foreach($category as $cate)
                              <li><a href="{{url('category_search',$cate->category_name)}}">{{$cate->category_name}}</a></li>
                              @endforeach
                           </ul>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="{{url('contact')}}">Contact</a>
                        </li>
                        <li class="nav-item active">
                           <a class="nav-link" href="{{url('show_order')}}">Order</a>
                        </li>
                        <li class="nav-item ">
                           <a class="nav-link" href="{{url('show_cart')}}">My Cart</a>
                        </li>
                        @if (Route::has('login'))

                        @auth
                        <li class="nav-item">
                           <x-app-layout>

                           </x-app-layout>
                        </li>
                        @else
                        <li class="nav-item">
                           <a class="btn btn-primary" id="logincss" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                           <a class="btn btn-success" href="{{ route('register') }}">Register</a>
                        </li>
                        @endauth
                        
                        @endif
                        
                     </ul>
                  </div>
               </nav>
            </div>
         </header>
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
                            <tr class="th_color">
                                <th>NO</th>
                                <th>Payment Status</th>
                                <th>Delivery Status</th>
                                <th>Created At</th>
                                <th>Order Detail</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($order as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->payment_status}}</td>
                                <td>{{$item->deliver_status}}</td>
                                <td>{{$item->created_at}}</td>
                                <td>
                                    <a href="{{url('show_order_detail',$item->id)}}" class="btn btn-primary">Order Detail</a>
                                </td>
                                <td>
                                    @if($item->deliver_status == 'processing')
                                    <a onclick="return confirm('Are you sure to cancel this order ?')" href="{{url('cancel',$item->id)}}" class="btn btn-primary">Cancel Order</a>
                                    @else
                                    <p>Can't Cancel Order</p>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="16" style="text-align:center; font-size:20px; color:white">
                                    No Order Found
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div style="width:10%; margin:auto;padding:20px;">
                    {{ $order->links() }}
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