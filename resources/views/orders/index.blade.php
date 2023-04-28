@extends('layouts.master')

@section('title')
    Orders
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
                        <h5 class="m-b-10">Orders</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('orders')}}">Orders</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end -->
    <!-- [ Main Content ] start -->

    @if(session()->has('success'))


        <div class="alert alert-success alert-dismissible fade show" role="alert">

            {{session()->get('success')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>


    @endif


    <div class="row">
        <!-- customar project  start -->
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center m-l-0">
                        <div class="col-sm-6">
                        </div>

                    </div>
                    <div class="table-responsive">
                        <table id="report-table" class="table mb-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Order</th>
                                <th>Full Name</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th>Payment Status</th>
                                <th>payment Method</th>
                                <th>Transication ID</th>
                                <th>Total</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>
                                        <a href="{{url('invoice',[$order->id])}}">
                                        {{$order->order_num}}
                                        </a>
                                    </td>
                                    <td>{{$order->user->first_name." ".$order->user->last_name}}</td>
                                    <td>{{$order->phone}}</td>
                                    <td>{{$order->address}}</td>
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
                                    <td>{{$order->payment_status}}</td>
                                    <td>{{$order->payment_method}}</td>
                                    <td>{{$order->transaction_id}}</td>
                                    <td>{{$order->total}}</td>
                                    <td>{{$order->created_at}}</td>

                                    <td>
                                        <button class="btn btn-info btn-sm"data-bs-toggle="modal"data-bs-target="#editOrder{{$order->id}}"><i class="feather icon-edit"></i>&nbsp;Edit </button>
                                        <button  class="btn btn-danger btn-sm"data-bs-toggle="modal"  data-bs-target="#deleteOrder{{$order->id}}"><i class="feather icon-trash-2"></i>&nbsp;Delete </button>
                                    </td>
                                </tr>






                                {{-- edit status of order modal --}}
                                <div id="editOrder{{$order->id}}" class="modal fade" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLiveLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLiveLabel">Edit Status Of Order</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('orders.update.status',[$order->id])}}" method="post">
                                                    @csrf

                                                    <div class="row">

                                                        <div class="col-md-12 text-center">
                                                           <select  name="status" class="form-select">
                                                               <option {{$order->status =='Is Pending'?'selected':''}} value="Is Pending">Is Pending</option>
                                                               <option {{$order->status =='Completed'?'selected':''}} value="Completed">Completed</option>
                                                               <option {{$order->status =='Canceled'?'selected':''}} value="Canceled">Canceled</option>
                                                               <option {{$order->status =='In Progress'?'selected':''}} value="In Progress">In Progress</option>
                                                           </select>
                                                        </div>

                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn  btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn  btn-success">Edit</button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!--  end -->



                                {{-- Delete Order--}}
                                <div id="deleteOrder{{$order->id}}" class="modal fade" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLiveLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLiveLabel">Create Category</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{url('destroy',$order->id)}}" method="get">
                                                    @csrf

                                                    <div class="row">

                                                        <div class="col-md-12 text-center">
                                                            Do you sure from delete operation ?
                                                            <br><br>
                                                        </div>

                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn  btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn  btn-danger">Delete</button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!--  end -->







                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>





@endsection


@section('js')

    <script src="{{asset('admin/assets/js/plugins/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/plugins/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Apex Chart -->
    <script src="{{asset('admin/assets/js/plugins/apexcharts.min.js')}}"></script>
    <script>
        // DataTable start
        $('#report-table').DataTable();
        // DataTable end
    </script>
@endsection

