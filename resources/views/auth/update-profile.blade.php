@extends('layouts.master')

@section('title')
    Blank
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
                        <h5 class="m-b-10">Product</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">E-Commerce</a></li>
                        <li class="breadcrumb-item"><a href="#!">Product</a></li>
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
                    <form action="{{route('profile.edit')}}"method="post" enctype="multipart/form-data">
                        @csrf

                                <div class="form-group">
                                    <label class="floating-label" for="name">name:</label>
                                    <input type="text" name="name"value="{{$admin->name}}" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="">
                                    @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="floating-label" for="email">email:</label>
                                    <input type="email" name="email"value="{{$admin->email}}" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="">
                                    @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="floating-label" for="password">password:</label>
                                    <input type="password" name="password" value="" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="">
                                    @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <label class="floating-label" for="photo">photo:</label>
                                <br>
                                <img  style="max-width: 50px" src="{{asset('Imgs/admins/'.auth()->guard('admin')->user()->photo)}}" class="img-radius" alt="User-Profile-Image">

                                <div class="form-group">
                                    <input type="file" name="photo" value="" class="form-control  @error('photo') is-invalid @enderror" id="photo">
                                     @error('photo')
                                     <div class="text-danger">{{ $message }}</div>
                                     @enderror
                                </div>



                        <button type="submit" class="btn btn-primary w-100">Save</button>
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
