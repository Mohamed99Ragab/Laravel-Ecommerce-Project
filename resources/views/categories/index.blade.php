@extends('layouts.master')

@section('title')
    Categories
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
                        <h5 class="m-b-10">Categories</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('categories.index')}}">Categories</a></li>
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
                        <div class="col-sm-6 text-end">
                            <button class="btn btn-success btn-sm btn-round has-ripple m-2" data-bs-toggle="modal"data-bs-target="#addCategory"><i class="feather icon-plus"></i> Add</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="report-table" class="table mb-0">
                            <thead>
                            <tr>
                                <th>Image</th>
                                <th>Category</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cats as $cat)
                            <tr>
                                <td>
                                    <img src="{{asset('Imgs/categories/'.$cat->cat_img)}}"style="max-width: 70px" class="img-fluid rounded" alt="">
                                </td>
                                <td>{{$cat->name}}</td>
                                <td>
                                    <button class="btn btn-info btn-sm"data-bs-toggle="modal"data-bs-target="#editCategory{{$cat->id}}"><i class="feather icon-edit"></i>&nbsp;Edit </button>
                                    <button  class="btn btn-danger btn-sm"data-bs-toggle="modal"  data-bs-target="#deleteCategory{{$cat->id}}"><i class="feather icon-trash-2"></i>&nbsp;Delete </button>
                                </td>
                            </tr>





                            {{-- Edit Category--}}
                            <div id="editCategory{{$cat->id}}" class="modal fade" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLiveLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLiveLabel">Edit Category</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('categories.update',[$cat->id])}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="row">

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="floating-label" for="Text">Category name:</label>
                                                            <input type="text"name="name"value="{{$cat->name}}" class="form-control" id="Text" placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <img src="{{asset('Imgs/categories/'.$cat->cat_img)}}"class="rounded"style="max-width: 100px" alt="Category Img" srcset="">
                                                            <br><br>
                                                            <input type="file"class="form-control" name="file">
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn  btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn  btn-info">Edit</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!--  end -->



                            {{-- Delete Category--}}
                            <div id="deleteCategory{{$cat->id}}" class="modal fade" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLiveLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLiveLabel">Create Category</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('categories.destroy',[$cat->id])}}" method="post" enctype="multipart/form-data">
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
    </div>



    {{-- Add Category--}}
    <div id="addCategory" class="modal fade" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalLiveLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLiveLabel">Create Category</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('categories.store')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="floating-label" for="Text">Category name:</label>
                                                <input type="text"name="name" class="form-control" id="Text" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <input type="file" name="file">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn  btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn  btn-success">Add</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
    <!--  end -->


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

