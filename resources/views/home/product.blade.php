<section class="product_section layout_padding">
         <div class="container">
            <div class="heading_container heading_center">
               <h2>
                  Our <span>products</span>
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