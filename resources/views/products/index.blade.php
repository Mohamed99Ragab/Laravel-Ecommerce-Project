@extends('layouts.master')

@section('title')
    Products
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
                        <h5 class="m-b-10">Products</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#!">Products</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end -->
    <!-- [ Main Content ] start -->
    <div class="row">


        @if(session()->has('success'))


            <div class="alert alert-success alert-dismissible fade show" role="alert">

                {{session()->get('success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>


        @endif






        <!-- customar project  start -->
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center m-l-0">
                        <div class="col-sm-6">
                        </div>
                        <div class="col-sm-6 text-end">
                            <a href="{{url('products/create')}}" class="btn btn-success btn-sm btn-round has-ripple m-2" ><i class="feather icon-plus"></i> Add Product</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="report-table" class="table mb-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>New Price</th>
                                <th>Quantity</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    <img src="{{asset('Imgs/products/'.$product->product_img)}}" class="img-fluid  wid-40" alt="">
                                </td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->category->name}}</td>
                                <td>{{number_format($product->new_price,2)}}$</td>
                                <td>{{$product->quantity}}</td>
                                @if($product->quantity >1)
                                <td><span class="badge bg-success">In Stock</span></td>
                                @elseif($product->quantity<1 )
                                    <td><span class="badge bg-danger">Out Of Stock</span></td>
                                @elseif($product->quantity ==1 )
                                    <td><span class="badge bg-warning">Latest Item</span></td>
                                @endif
                                <td>
                                    <a href="{{route('products.edit',$product->id)}}" class="btn btn-info btn-sm"><i class="feather icon-edit"></i>&nbsp;Edit </a>
                                    <button type="button" class="btn btn-danger btn-sm"data-bs-toggle="modal"  data-bs-target="#deleteProduct{{$product->id}}"><i class="feather icon-trash-2"></i>&nbsp;Delete </button>
                                </td>
                            </tr>




                            {{-- Delete Product--}}
                            <div id="deleteProduct{{$product->id}}" class="modal fade" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLiveLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLiveLabel">Delete Product</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('products.destroy',[$product->id])}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                @method('DELETE')
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
        <!-- customar project  end -->
    </div>
    <!-- [ Main Content ] end -->







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










