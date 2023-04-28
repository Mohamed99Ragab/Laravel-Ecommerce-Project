@extends('layouts.master')

@section('title')
    Invocie Of Order {{$order->order_num}}
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('admin/assets/css/plugins/dataTables.bootstrap4.min.css')}}">

@endsection


@section('content')
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Product</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{route('orders')}}">Orders</a></li>
                        <li class="breadcrumb-item"><a href="{{url('invoice',[$order->id])}}">Invoice of order {{$order->order_num}}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end -->
    <!-- [ Main Content ] start -->
    <div class="row">
        <!-- [ Invoice ] start -->
        <div class="container" id="printTable">
            <div>
                <div class="card">
                    <div class="card-body">
                        <div class="invoice-contact">
                            <div class="invoice-box">
                                <table class="table table-responsive invoice-table table-borderless p-l-20">
                                    <tbody>
                                    <tr>
                                        <td><a href="#" class="b-brand">
{{--                                                <img class="img-fluid" src="assets/images/logo-dark.png" alt="Able pro Logo">--}}
                                                    <h3>ELGWILE</h3>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>elgwile company for shopping </td>
                                    </tr>
                                    <tr>
                                        <td>Egypt - Beni Suif - Alfshin city</td>
                                    </tr>
                                    <tr>
                                        <td><a class="text-secondary" href="mailto:mohamed.ragab.lara@gmail.com" target="_top">mohamed.ragab.lara@gmail.com</a></td>
                                    </tr>
                                    <tr>
                                        <td>+201017309597</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row invoive-info">
                            <div class="col-md-4 col-xs-12 invoice-client-info">
                                <h6>Client Information :</h6>
                                <h6 class="m-0">{{$order->user->first_name." ".$order->user->last_name}}</h6>
                                <p class="m-0 m-t-10">{{$order->address}}</p>
                                <p class="m-0">{{$order->phone}}</p>
                                <p><a class="text-secondary" href="mailto:{{$order->user->email}}" target="_top">{{$order->user->email}}</a></p>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <h6>Order Information :</h6>
                                <table class="table table-responsive invoice-table invoice-order table-borderless">
                                    <tbody>
                                    <tr>
                                        <th>Date :</th>
                                        <td>{{$order->created_at}}</td>
                                    </tr>
                                    <tr>
                                        <th>Status :</th>
                                        <td>
                                            @if($order->status =='Completed')
                                                <span class="badge badge-light-success">{{$order->status}}</span>

                                            @elseif($order->status =='Is Pending')
                                                <span class="badge badge-light-info">{{$order->status}}</span>

                                            @elseif($order->status =='In Progress')
                                                <span class="badge badge-light-primary">{{$order->status}}</span>

                                            @elseif($order->status =='Canceled')
                                                <span class="badge badge-light-danger">{{$order->status}}</span>

                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Id :</th>
                                        <td>
                                            {{$order->order_num}}
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <h6><span class="text-uppercase text-primary">TOTAL DUE :</span>
                                    <span>${{number_format($order->total)}}</span>
                                </h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table invoice-detail-table">
                                        <thead>
                                        <tr class="thead-default">
                                            <th>Product Image</th>
                                            <th>Product Name</th>
                                            <th>Quantity</th>
                                            <th>Amount</th>
                                            <th>Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($order->orderDetails as $item)
                                            <tr>
                                                <td>
                                                    <img style="max-width: 70px" class="rounded" src="{{$item->product_img}}" alt="product img" srcset="">
                                                </td>
                                                <td>
                                                    <h6>{{$item->product_name}}</h6>
                                                </td>
                                                <td>{{$item->quantity}}</td>
                                                <td>{{$item->price}}</td>
                                                <td>{{$item->quantity * $item->price}}</td>
                                            </tr>

                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-responsive invoice-table invoice-total">
                                    <tbody>
                                    <tr>
                                        <th>Sub Total :</th>
                                        <td>${{number_format($order->total)}}</td>
                                    </tr>
                                    <tr>
                                        <th>Taxes (0%) :</th>
                                        <td>$0.00</td>
                                    </tr>
                                    <tr>
                                        <th>Discount (0%) :</th>
                                        <td>$0.00</td>
                                    </tr>
                                    <tr class="text-info">
                                        <td>
                                            <hr />
                                            <h5 class="text-primary m-r-10">Total :</h5>
                                        </td>
                                        <td>
                                            <hr />
                                            <h5 class="text-primary">$ {{number_format($order->total)}}</h5>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <h6>Terms and Condition :</h6>
                                <p>lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                                    laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row text-center print-btn">
                    <div class="col-sm-12 invoice-btn-group text-center">
                        <button type="button" class="btn waves-effect waves-light btn-primary btn-print-invoice m-b-10">Print</button>
                        <a href="{{route('orders')}}" class="btn waves-effect waves-light btn-secondary m-b-10 ">back</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Invoice ] end -->
    </div>
    <!-- [ Main Content ] end -->


@endsection

@section('js')
    <script src="{{asset('admin/assets/js/menu-setting.min.js')}}"></script>

    <script>
        document.querySelector('.btn-print-invoice').addEventListener('click', function () {
            var link2 = document.createElement('link');
            link2.innerHTML =
                '<style>@media print{*,::after,::before{text-shadow:none!important;box-shadow:none!important}.pcoded-main-container{margin-left:0px;}a:not(.btn){text-decoration:none}abbr[title]::after{content:" ("attr(title) ")"}pre{white-space:pre-wrap!important}blockquote,pre{border:1px solid #adb5bd;page-break-inside:avoid}thead{display:table-header-group}img,tr{page-break-inside:avoid}h2,h3,p{orphans:3;widows:3}h2,h3{page-break-after:avoid}@page{size:a3}body{min-width:992px!important}.container{min-width:992px!important}.page-header,.pc-sidebar,.pc-mob-header,.pc-header,.pct-customizer,.modal,.pcoded-navbar,.print-btn{display:none}.pc-container{top:0;}.invoice-contact{padding-top:0;}@page,.card-body,.card-header,body,.pcoded-content{padding:0;margin:0}.badge{border:1px solid #000}.table{border-collapse:collapse!important}.table td,.table th{background-color:#fff!important}.table-bordered td,.table-bordered th{border:1px solid #dee2e6!important}.table-dark{color:inherit}.table-dark tbody+tbody,.table-dark td,.table-dark th,.table-dark thead th{border-color:#dee2e6}.table .thead-dark th{color:inherit;border-color:#dee2e6}}</style>';

            document.getElementsByTagName('head')[0].appendChild(link2);
            window.print();
        })
    </script>
@endsection
