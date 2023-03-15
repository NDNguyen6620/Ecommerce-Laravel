<section class="product_section layout_padding">
         <div class="container">
            <div class="heading_container heading_center">
               <h2>
                  Our <span>products</span>
               </h2>
            </div>
            
            <div class="row">
            @foreach($product as $data)
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
            @endforeach
            </div>
         </div>
      </section>