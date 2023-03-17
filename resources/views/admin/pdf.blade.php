<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Order Details PDF</title>
    <style type="text/css">
        .center{
            width:50%;
            margin:auto;
            border:2px solid white;
            margin-top:40px; 
        }
        .font_size2{
            text-align:center;
            font-size:25px;
            padding-top:20px;
        }
        th,td{
            text-align:center;
            border:1px solid black;
        }
        
    </style>
</head>
<body>
    <h1>Order details</h1>

   Customer Name: <h3>{{$order->name}}</h3>

   Customer Email: <h3>{{$order->email}}</h3>

   Customer Phone: <h3>{{$order->phone}}</h3>

   Customer Address: <h3>{{$order->address}}</h3>

   Customer Id: <h3>{{$order->user_id}}</h3>
        <div class="main-panel">
            <div class="content-wrapper">
                <h2 class="font_size">Order Detail</h2>
                    <table class="table center" style="border:2px solid black;">
                        <thead>
                            <tr class="th_color">
                                <th>Product Id</th>
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
                                <td>{{$data->product_id}}</td>
                                <td scope="row">{{$data->product_title}}</td>
                                <td>{{$data->quantity}}</td>
                                <td>{{$data->price * $data->quantity}}</td>
                                <td>
                                    <img width="50px" src="product_image/{{$data->image}}" alt="">
                                </td>                           
                            </tr>
                            <?php $totalPrice = $totalPrice + ($data->price * $data->quantity) ?>
                            @endforeach
                        </tbody>
                    </table>
                    <h4 class="font_size2">Total Price: {{$totalPrice}}</h4>
                    
            </div>
        </div>
   Payment Status: <h3>{{$order->payment_status}}</h3>

   
</body>
</html>