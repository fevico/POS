@extends('admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="content">

<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">POS</a></li>
                        <li class="breadcrumb-item active">POS</li>
                    </ol>
                </div>
                <h4 class="page-title">POS</h4>
            </div>
        </div>
    </div>     
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-4 col-xl-6">
            <div class="card text-center">
                <div class="card-body">

                <div class="table-responsive">
                <table class="table table-bordered border-primary mb-0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>QTY</th>
                            <th> Price</th>
                            <th>SubTotal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    @php 
                        $allcart = Cart::content();
                    @endphp
                    <tbody>
                        @foreach($allcart as $cart)
                        <tr>
                            <td>{{ $cart->name}}</td>
                            <td>
            <form method="post" action="{{ url('/cart/update/'.$cart->rowId) }}">

            @csrf 

        <input type="number" name="qty" value="{{ $cart->qty }}" style="width:40px;" min="1">
        <button type="subit" class="btn btn-sm btn-success"><i class="fas fa-check" style"margin-top:5px;"></i></button>

        </form>
                            </td>
                            <td>{{ $cart->price}}</td>
                            <td>{{ $cart->price * $cart->qty}}</td>
            <td><a href="{{ url('/cart-remove/'.$cart->rowId) }}"><i class="fas fa-trash-alt" style="color:#ffffff;"></i></a></td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            
            <div class="bg bg-primary">
            <br>
                <p style="font-size:18px; color:#ffffff;"> Quantity : {{ Cart::count() }}</p>
                <p style="font-size:18px; color:#ffffff;"> SubTotal : {{Cart::subtotal();}}</p>
                <p style="font-size:18px; color:#ffffff;"> Vat : {{Cart::tax(); }}</p>
                <p><h2 class="text-white"> Total </h2><h1 class="text-white"> {{Cart::total(); }} </h1></p>
                <br>
            </div>
            <br>

            <form action="">
    
            <div class="form-group mb-3">
                <label for="firstname" class="form-label">All Customer</label>

    <a href="{{ route('add-cutomer') }}" class="btn btn-danger rounded-pill waves-effect waves-light mb-2">Add Customer</a>

        <select name="supplier_id" class="form-select" id="example-select">
             <option selected>Selecr Here</option>
                <option selected disabled>Select Customer</option>
                @foreach($customer as $cust)
                <option value="{{ $cust->id }}">{{ $cust->name}}</option>
                @endforeach
            </select>
    
            </div>

            <button class="btn btn-blue waves-effect-light">Create Invoice</button>

            </form>
            
                </div>                                 
            </div> 

        </div> <!-- end col-->

        <div class="col-lg-8 col-xl-6">
            <div class="card">
                <div class="card-body">
                    
                        <!-- end about me section content -->

                        <!-- end timeline content-->

    <div class="tab-pane" id="settings">
        
    <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th> </th>
                    </tr>
                </thead>
            

    <tbody>
        @foreach($product as $key=> $item)
        <tr>
            <form method="post" action="{{ url('/add-cart') }}">
                @csrf 
                <input type="hidden" name="id" value="{{ $item->id }}">
                <input type="hidden" name="name" value="{{ $item->product_name }}">
                <input type="hidden" name="qty" value="1">
                <input type="hidden" name="price" value="{{ $item->selling_price }}">

            <td>{{ $key+1}}</td>
            <td><img src="{{ asset($item->product_image) }}" alt="" style="width:50px; height:40px;"></td>
            <td>{{ $item->product_name }}</td>
            <td><button type="submit" style="font-size:20px; color:#000;">
        <i class="fas fa-plus-square"></i></button></td>

        </form>

        </tr>
        @endforeach
        </tbody>
            </table>


        </div>
                        <!-- end settings content-->
                </div>
            </div> <!-- end card-->

        </div> <!-- end col -->
    </div>
    <!-- end row-->

</div> <!-- container -->

</div> 

@endsection 