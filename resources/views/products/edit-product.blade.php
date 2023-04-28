@extends('layouts.master')

@section('title')
    Edit Product
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
                        <h5 class="m-b-10">Edit Product</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="feather icon-home"></i>Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('products.index')}}">Product List</a></li>
                        <li class="breadcrumb-item"><a href="{{route('products.edit',$product->id)}}">Product Edit</a></li>
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
                    <form action="{{route('products.update',$product->id)}}"method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="floating-label" for="name">Product name:</label>
                                    <input type="text"name="name"value="{{$product->name}}" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="">
                                    @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group ">

                                    <select class="form-select @error('cat_id') is-invalid @enderror"name="cat_id">
                                        <option readonly=""disabled selected>Select Product Category..</option>
                                        @foreach($cats as $cat)
                                            <option value="{{$cat->id, old('cat_id')}}"{{$cat->id==$product->category_id?'selected':''}}>{{$cat->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('cat_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="floating-label"for="old_price" >Old Price:</label>
                                    <input type="number" value="{{$product->old_price}}" name="old_price"id="old_price" class="form-control @error('old_price') is-invalid @enderror"  placeholder="">

                                    @error('old_price')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="floating-label"for="new_price" >New Price:</label>
                                    <input type="number" value="{{$product->new_price}}" name="new_price"id="new_price" class="form-control @error('new_price') is-invalid @enderror"  placeholder="">
                                    @error('new_price')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label  >Quantity:</label>
                                    <input type="number" value="{{$product->quantity}}" name="quantity" class="form-control @error('quantity') is-invalid @enderror"  placeholder="">

                                    @error('quantity')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label  >Image:</label>
                                    <img src="{{asset('Imgs/products/'.$product->product_img)}}" class="img-fluid img-radius wid-40" alt="">

                                    <input type="file"name="product_img"value="{{old('product_img')}}" class="form-control @error('product_img') is-invalid @enderror"  placeholder="">
                                    @error('product_img')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="is_feature"  class="form-check-label">Featured:</label>

                                    <input id="is_feature" class="form-check-input" type="checkbox" value="featured" {{$product->is_feature=='featured'?'checked':''}} name="is_feature">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="" >Description:</label>
                                    <textarea rows="5" name="desc" class="form-control @error('desc') is-invalid @enderror"  placeholder="write product desc here..">{{$product->desc}} </textarea>
                                    @error('desc')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Update</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- customar project  end -->
    </div>
    <!-- [ Main Content ] end -->


@endsection

@section('js')


@endsection
