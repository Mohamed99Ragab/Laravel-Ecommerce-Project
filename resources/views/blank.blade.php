@extends('layouts.master')

@section('title')
    Blank
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
        <!-- customar project  start -->
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center m-l-0">
                        <div class="col-sm-6">
                        </div>
                        <div class="col-sm-6 text-end">
                            <button class="btn btn-success btn-sm btn-round has-ripple m-2" data-bs-toggle="modal" data-bs-target="#modal-report"><i class="feather icon-plus"></i> Sellers</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="report-table" class="table mb-0">
                            <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Revenue</th>
                                <th>Create Date</th>
                                <th>Products</th>
                                <th>Status</th>
                                <th>Options</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <img src="{{asset('admin/assets/images/user/avatar-2.jpg')}}" class="img-fluid img-radius wid-40" alt="">
                                </td>
                                <td>Micheal Pewd</td>
                                <td>patient@temp.com</td>
                                <td>+984-9388638</td>
                                <td>$451,45</td>
                                <td>09/10/1990</td>
                                <td>456</td>
                                <td><span class="badge bg-danger">Disabled</span></td>
                                <td>
                                    <a href="#!" class="btn btn-info btn-sm"><i class="feather icon-edit"></i>&nbsp;Edit </a>
                                    <a href="#!" class="btn btn-danger btn-sm"><i class="feather icon-trash-2"></i>&nbsp;Delete </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="assets/images/user/avatar-3.jpg" class="img-fluid img-radius wid-40" alt="">
                                </td>
                                <td>Erich Mcbride</td>
                                <td>xidim@temp.com</td>
                                <td>+612-1385682</td>
                                <td>$396,73</td>
                                <td>09/10/1990</td>
                                <td>354</td>
                                <td><span class="badge bg-success">Active</span></td>
                                <td>
                                    <a href="#!" class="btn btn-info btn-sm"><i class="feather icon-edit"></i>&nbsp;Edit </a>
                                    <a href="#!" class="btn btn-danger btn-sm"><i class="feather icon-trash-2"></i>&nbsp;Delete </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="assets/images/user/avatar-3.jpg" class="img-fluid img-radius wid-40" alt="">
                                </td>
                                <td>Micheal Pewd</td>
                                <td>patient@temp.com</td>
                                <td>+984-9388638</td>
                                <td>$451,45</td>
                                <td>09/10/1990</td>
                                <td>27</td>
                                <td><span class="badge bg-danger">Disabled</span></td>
                                <td>
                                    <a href="#!" class="btn btn-info btn-sm"><i class="feather icon-edit"></i>&nbsp;Edit </a>
                                    <a href="#!" class="btn btn-danger btn-sm"><i class="feather icon-trash-2"></i>&nbsp;Delete </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="assets/images/user/avatar-5.jpg" class="img-fluid img-radius wid-40" alt="">
                                </td>
                                <td>Erich Mcbride</td>
                                <td>xidim@temp.com</td>
                                <td>+612-1385682</td>
                                <td>$396,73</td>
                                <td>09/10/1990</td>
                                <td>54</td>
                                <td><span class="badge bg-success">Active</span></td>
                                <td>
                                    <a href="#!" class="btn btn-info btn-sm"><i class="feather icon-edit"></i>&nbsp;Edit </a>
                                    <a href="#!" class="btn btn-danger btn-sm"><i class="feather icon-trash-2"></i>&nbsp;Delete </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="assets/images/user/avatar-1.jpg" class="img-fluid img-radius wid-40" alt="">
                                </td>
                                <td>Micheal Pewd</td>
                                <td>patient@temp.com</td>
                                <td>+984-9388638</td>
                                <td>$451,45</td>
                                <td>09/10/1990</td>
                                <td>46</td>
                                <td><span class="badge bg-success">Active</span></td>
                                <td>
                                    <a href="#!" class="btn btn-info btn-sm"><i class="feather icon-edit"></i>&nbsp;Edit </a>
                                    <a href="#!" class="btn btn-danger btn-sm"><i class="feather icon-trash-2"></i>&nbsp;Delete </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="assets/images/user/avatar-2.jpg" class="img-fluid img-radius wid-40" alt="">
                                </td>
                                <td>Micheal Pewd</td>
                                <td>patient@temp.com</td>
                                <td>+984-9388638</td>
                                <td>$451,45</td>
                                <td>09/10/1990</td>
                                <td>257</td>
                                <td><span class="badge bg-success">Active</span></td>
                                <td>
                                    <a href="#!" class="btn btn-info btn-sm"><i class="feather icon-edit"></i>&nbsp;Edit </a>
                                    <a href="#!" class="btn btn-danger btn-sm"><i class="feather icon-trash-2"></i>&nbsp;Delete </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="assets/images/user/avatar-3.jpg" class="img-fluid img-radius wid-40" alt="">
                                </td>
                                <td>Erich Mcbride</td>
                                <td>xidim@temp.com</td>
                                <td>+612-1385682</td>
                                <td>$396,73</td>
                                <td>09/10/1990</td>
                                <td>73</td>
                                <td><span class="badge bg-success">Active</span></td>
                                <td>
                                    <a href="#!" class="btn btn-info btn-sm"><i class="feather icon-edit"></i>&nbsp;Edit </a>
                                    <a href="#!" class="btn btn-danger btn-sm"><i class="feather icon-trash-2"></i>&nbsp;Delete </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="assets/images/user/avatar-3.jpg" class="img-fluid img-radius wid-40" alt="">
                                </td>
                                <td>Micheal Pewd</td>
                                <td>patient@temp.com</td>
                                <td>+984-9388638</td>
                                <td>$451,45</td>
                                <td>09/10/1990</td>
                                <td>84</td>
                                <td><span class="badge bg-danger">Disabled</span></td>
                                <td>
                                    <a href="#!" class="btn btn-info btn-sm"><i class="feather icon-edit"></i>&nbsp;Edit </a>
                                    <a href="#!" class="btn btn-danger btn-sm"><i class="feather icon-trash-2"></i>&nbsp;Delete </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="assets/images/user/avatar-5.jpg" class="img-fluid img-radius wid-40" alt="">
                                </td>
                                <td>Erich Mcbride</td>
                                <td>xidim@temp.com</td>
                                <td>+612-1385682</td>
                                <td>$396,73</td>
                                <td>09/10/1990</td>
                                <td>246</td>
                                <td><span class="badge bg-success">Active</span></td>
                                <td>
                                    <a href="#!" class="btn btn-info btn-sm"><i class="feather icon-edit"></i>&nbsp;Edit </a>
                                    <a href="#!" class="btn btn-danger btn-sm"><i class="feather icon-trash-2"></i>&nbsp;Delete </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="assets/images/user/avatar-1.jpg" class="img-fluid img-radius wid-40" alt="">
                                </td>
                                <td>Micheal Pewd</td>
                                <td>patient@temp.com</td>
                                <td>+984-9388638</td>
                                <td>$451,45</td>
                                <td>09/10/1990</td>
                                <td>742</td>
                                <td><span class="badge bg-success">Active</span></td>
                                <td>
                                    <a href="#!" class="btn btn-info btn-sm"><i class="feather icon-edit"></i>&nbsp;Edit </a>
                                    <a href="#!" class="btn btn-danger btn-sm"><i class="feather icon-trash-2"></i>&nbsp;Delete </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="assets/images/user/avatar-2.jpg" class="img-fluid img-radius wid-40" alt="">
                                </td>
                                <td>Micheal Pewd</td>
                                <td>patient@temp.com</td>
                                <td>+984-9388638</td>
                                <td>$451,45</td>
                                <td>09/10/1990</td>
                                <td>765</td>
                                <td><span class="badge bg-success">Active</span></td>
                                <td>
                                    <a href="#!" class="btn btn-info btn-sm"><i class="feather icon-edit"></i>&nbsp;Edit </a>
                                    <a href="#!" class="btn btn-danger btn-sm"><i class="feather icon-trash-2"></i>&nbsp;Delete </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="assets/images/user/avatar-3.jpg" class="img-fluid img-radius wid-40" alt="">
                                </td>
                                <td>Erich Mcbride</td>
                                <td>xidim@temp.com</td>
                                <td>+612-1385682</td>
                                <td>$396,73</td>
                                <td>09/10/1990</td>
                                <td>345</td>
                                <td><span class="badge bg-success">Active</span></td>
                                <td>
                                    <a href="#!" class="btn btn-info btn-sm"><i class="feather icon-edit"></i>&nbsp;Edit </a>
                                    <a href="#!" class="btn btn-danger btn-sm"><i class="feather icon-trash-2"></i>&nbsp;Delete </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="assets/images/user/avatar-3.jpg" class="img-fluid img-radius wid-40" alt="">
                                </td>
                                <td>Micheal Pewd</td>
                                <td>patient@temp.com</td>
                                <td>+984-9388638</td>
                                <td>$451,45</td>
                                <td>09/10/1990</td>
                                <td>743</td>
                                <td><span class="badge bg-success">Active</span></td>
                                <td>
                                    <a href="#!" class="btn btn-info btn-sm"><i class="feather icon-edit"></i>&nbsp;Edit </a>
                                    <a href="#!" class="btn btn-danger btn-sm"><i class="feather icon-trash-2"></i>&nbsp;Delete </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="assets/images/user/avatar-5.jpg" class="img-fluid img-radius wid-40" alt="">
                                </td>
                                <td>Erich Mcbride</td>
                                <td>xidim@temp.com</td>
                                <td>+612-1385682</td>
                                <td>$396,73</td>
                                <td>09/10/1990</td>
                                <td>234</td>
                                <td><span class="badge bg-success">Active</span></td>
                                <td>
                                    <a href="#!" class="btn btn-info btn-sm"><i class="feather icon-edit"></i>&nbsp;Edit </a>
                                    <a href="#!" class="btn btn-danger btn-sm"><i class="feather icon-trash-2"></i>&nbsp;Delete </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="assets/images/user/avatar-1.jpg" class="img-fluid img-radius wid-40" alt="">
                                </td>
                                <td>Micheal Pewd</td>
                                <td>patient@temp.com</td>
                                <td>+984-9388638</td>
                                <td>$451,45</td>
                                <td>09/10/1990</td>
                                <td>624</td>
                                <td><span class="badge bg-danger">Disabled</span></td>
                                <td>
                                    <a href="#!" class="btn btn-info btn-sm"><i class="feather icon-edit"></i>&nbsp;Edit </a>
                                    <a href="#!" class="btn btn-danger btn-sm"><i class="feather icon-trash-2"></i>&nbsp;Delete </a>
                                </td>
                            </tr>
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
