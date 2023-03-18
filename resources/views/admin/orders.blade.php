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
        th{
            border:1px solid black;
        }
        td{
            border:1px solid white;

        }
        .i_search{
            height:27px;
            color: black;
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
                <h2 class="font_size">All Orders</h2>
                <div style="width: 30% ; margin: auto; padding-bot:20px; padding-top:20px;">
                    <form action="{{url('search')}}" method="GET">
                        @csrf
                       <input class="i_search" type="text" name="search" placeholder="Search order">
                       <input type="submit" value="search" class="btn btn-outline-primary">
                    </form>
                </div>
                    <table class="table center" style="border:2px solid white;">
                        <thead>
                            <tr class="th_color">
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Payment Status</th>
                                <th>Delivery Status</th>
                                <th>Created At</th>
                                <th>Order Detail</th>
                                <th>Update</th>
                                <th>Print PDF</th>
                                <th>Send Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($order as $data)
                            <tr>
                                <td scope="row">{{$data->name}}</td>
                                <td>{{$data->phone}}</td>
                                <td>{{$data->email}}</td>
                                <td>{{$data->payment_status}}</td>
                                <td>{{$data->deliver_status}}</td>
                                <td>{{$data->created_at}}</td>
                                <td>
                                    <a href="{{url('order_detail',$data->id)}}" class="btn btn-primary">Order Detail</a>
                                </td>
                                <td>
                                    @if($data->deliver_status == 'processing')
                                    <a onclick="return confirm('Are you sure this product is delivered ?')" href="{{url('delivered',$data->id)}}" class="btn btn-success">Delivered</a>
                                    @else
                                    <p  style="color: green;">Delivered</p>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{url('print_pdf',$data->id)}}" class="btn btn-secondary">Print PDF</a>
                                </td> 
                                <td>
                                    <a href="{{url('print_pdf',$data->id)}}" class="btn btn-secondary">Send Email</a>
                                </td>    

                            </tr>
                            @empty
                            <tr>
                                <td colspan="16" style="text-align:center; font-size:20px; color:white">
                                    No Data Found
                                </td>
                            </tr>
                            @endforelse
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