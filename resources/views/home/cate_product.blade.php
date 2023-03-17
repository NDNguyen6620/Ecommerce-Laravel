<!DOCTYPE html>
<html>
   <head>
      <base href="/product">
      <!-- Basic -->
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
                        <li class="nav-item dropdown active">
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
                        <li class="nav-item">
                           <a class="nav-link" href="{{url('show_order')}}">Order</a>
                        </li>
                        <li class="nav-item">
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
      <!-- why section -->
      <!-- product section -->
      <section class="product_section layout_padding">
         <div class="container">
            <div class="heading_container heading_center">
               <h2>
                  {{$name}} <span>products</span>
               </h2>
               <div>
                  <form action="{{url('product_search')}}" method="GET">
                     @csrf
                     <input style="width:500px; "type="text" name="search" placeholder="Search for Something">
                     <input type="submit" value="search">

                  </form>
               </div>
            </div>
            
            <div class="row">
            @forelse($product as $data)
               <div class="col-sm-6 col-md-4 col-lg-4">
                  <div class="box">
                     <div class="option_container">
                        <div class="options">
                           <a href="{{url('product_details',$data->id)}}" class="option1">
                           Product Details
                           </a>
                           <form action="{{url('add_cart',$data->id)}}" method="POST">
                              @csrf
                              <div class="row">
                                 <div class="col-md-4">
                                    <input type="number" name="quantity" value="1" min="1" style="width:100px;height:49.5px;"> 
                                 </div>
                                 <div class="col-md-4">
                                    <input type="submit" value="Add to cart" >
                                 </div>
                              </div>
                              
                           </form>
                        </div>
                     </div>
                     <div class="img-box">
                        <img src="product_image/{{$data->image}}" alt="">
                     </div>
                     <div class="detail-box">
                        <h5>
                           {{$data->title}}
                        </h5>
                        @if($data->discount_price!=null)
                        <h6 style="color:red;">
                           ${{$data->discount_price}}
                        </h6>
                        <h6 style="text-decoration:line-through;color:blue;">
                           ${{$data->price}}
                        </h6>
                        @else
                        <h6 style="color:blue;">
                           ${{$data->price}}
                        </h6>
                        @endif
                     </div>
                  </div>
               </div>
            @empty
               <div style="font-size:20px;">
                  Nothing Found
               </div>
            @endforelse
            
            <div style="padding:20px; margin:auto;"> {{ $product->links() }}</div>
            </div>
            
         </div>
         <div class="btn-box">
               <a href="{{url('all_product')}}">
               View All products
               </a>
            </div>
         
</section>
      <!-- end product section -->
      <!-- footer start -->
      @include('home.footer')
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