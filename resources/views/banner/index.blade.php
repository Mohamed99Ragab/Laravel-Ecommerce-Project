@extends('layouts.master')

@section('title')
    Application Banners
@endsection

@section('css')

@endsection


@section('content')
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Banners</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('banners.index')}}">Banners</a></li>
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
                                <th>Banner Img</th>
                                <th>Title</th>
                                <th>Offer</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($banners as $banner)
                                <tr>
                                    <td>
                                        <img src="{{asset('Imgs/banners/'.$banner->img_banner)}}"style="max-width: 70px" class="img-fluid rounded" alt="">
                                    </td>
                                    <td>{{$banner->title}}</td>
                                    <td>{{$banner->offer}}</td>
                                    <td>
                                        <button class="btn btn-info btn-sm"data-bs-toggle="modal"data-bs-target="#editBanner{{$banner->id}}"><i class="feather icon-edit"></i>&nbsp;Edit </button>
                                        <button  class="btn btn-danger btn-sm"data-bs-toggle="modal"  data-bs-target="#deleteBanner{{$banner->id}}"><i class="feather icon-trash-2"></i>&nbsp;Delete </button>
                                    </td>
                                </tr>





                                {{-- Edit Category--}}
                                <div id="editBanner{{$banner->id}}" class="modal fade" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLiveLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLiveLabel">Edit Banner</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('banners.update',[$banner->id])}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="row">

                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="floating-label" for="title">Banner Title:</label>
                                                                <input type="text"name="title"value="{{$banner->title}}" class="form-control" id="title" placeholder="">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="floating-label" for="offer">Banner Offer:</label>
                                                                <input type="text"name="offer"value="{{$banner->offer}}" class="form-control" id="offer" placeholder="">
                                                            </div>
                                                        </div>


                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <img src="{{asset('Imgs/banners/'.$banner->img_banner)}}"class="rounded"style="max-width: 100px" alt="Category Img" srcset="">
                                                                <br><br>
                                                                <input id="img_banner" type="file"class="form-control" name="img_banner">
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
                                <div id="deleteBanner{{$banner->id}}" class="modal fade" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLiveLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLiveLabel">Delete Banner</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('banners.destroy',[$banner->id])}}" method="post" enctype="multipart/form-data">
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
                    <h5 class="modal-title" id="exampleModalLiveLabel">Add Banner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('banners.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="col-md-12">
                                <label class="floating-label" for="title">Banner Title:</label>

                                <div class="form-group">
                                    <input type="text"name="title" class="form-control" id="title" placeholder="">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="floating-label" for="offer">Banner Offer:</label>
                                    <input type="text"name="offer" class="form-control" id="offer" placeholder="">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">

                                    <input id="img_banner" type="file" name="img_banner">
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


@endsection

