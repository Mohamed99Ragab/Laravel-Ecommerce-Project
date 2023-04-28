@extends('layouts.master')


@section('title')
    Admin Panel
@endsection


@section('content')
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Dashboard sale</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">Dashboard sale</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end -->
    <!-- [ Main Content ] start -->
    <div class="row">
        <!-- seo analytics start -->
        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h3>20500</h3>
                    <p class="text-muted">Site Analysis</p>
                    <div id="seo-anlytics1"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h3>${{number_format($totalSales)}}</h3>
                    <p class="text-muted">Total Sales</p>
                    <div id="seo-anlytics2"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h3>{{$users}}</h3>
                    <p class="text-muted">Users</p>
                    <div id="seo-anlytics3"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h3>59600</h3>
                    <p class="text-muted">Total Usage</p>
                    <div id="seo-anlytics4"></div>
                </div>
            </div>
        </div>
        <!-- seo analytics end -->
        <!-- Latest Order start -->
        <div class="col-lg-12 col-md-12">
            <div class="card table-card latest-activity-card">
                <div class="card-header">
                    <h5>Latest Order</h5>
                    <div class="card-header-right">
                        <div class="btn-group card-option">
                            <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="feather icon-more-horizontal"></i>
                            </button>
                            <ul class="list-unstyled card-option dropdown-menu dropdown-menu-end">
                                <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                                <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                                <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>
                                <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i> remove</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-borderless mb-0">
                            <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Order ID</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($latestOrders as $order)
                            <tr>
                                <td>{{$order->user->first_name .' '.$order->user->last_name  }}</td>
                                <td>{{$order->order_num}}</td>
                                <td>{{$order->phone}}</td>
                                <td>{{$order->address}}</td>
                                <td>{{$order->created_at}}</td>
                                <td>

                                    @if($order->status =='Completed')
                                        <label class="badge badge-light-success">{{$order->status}}</label>

                                    @elseif($order->status =='Is Pending')
                                        <label class="badge badge-light-warning">{{$order->status}}</label>

                                    @elseif($order->status =='In Progress')
                                        <label class="badge badge-light-primary">{{$order->status}}</label>

                                    @elseif($order->status =='Canceled')
                                        <label class="badge badge-light-danger">{{$order->status}}</label>

                                    @endif



                                </td>
                                <td>
                                    <a href="{{url('invoice',$order->id)}}">
                                        <i class="icon feather icon-eye f-w-600 f-16 m-r-15 text-c-green"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Latest Order end -->

        <!-- Latest Customers end -->
    </div>
    <!-- [ Main Content ] end -->
@endsection
