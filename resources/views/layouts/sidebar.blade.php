<nav class="pcoded-navbar menu-light ">
    <div class="navbar-wrapper  ">
        <div class="navbar-content scroll-div " >

            <div class="">
                <div class="main-menu-header">
                    <img class="img-radius" src="{{asset('Imgs/admins/'.auth()->guard('admin')->user()->photo)}}" alt="User-Profile-Image">
                    <div class="user-details">
                        <div id="more-details">Software engineer <i class="fa fa-caret-down"></i></div>
                    </div>
                </div>
                <div class="collapse" id="nav-user-link">
                    <ul class="list-inline">
                        <li class="list-inline-item"><a href="{{route('profile')}}" data-toggle="tooltip" title="View Profile"><i class="feather icon-user"></i></a></li>
                        <li class="list-inline-item"><a href="{{route('logout')}}" data-toggle="tooltip" title="Logout" class="text-danger"><i class="feather icon-power"></i></a></li>
                    </ul>
                </div>
            </div>

            <ul class="nav pcoded-inner-navbar ">
                <li class="nav-item pcoded-menu-caption">
                    <label>Navigation</label>
                </li>
                <li class="nav-item">
                    <a href="{{route('home')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                </li>
                <li class="nav-item">
                    <a href="{{route('categories.index')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layers"></i></span><span class="pcoded-mtext">Categories</span></a>
                </li>
                <li class="nav-item">
                    <a href="{{route('banners.index')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layers"></i></span><span class="pcoded-mtext">Banners</span></a>
                </li>

                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-users"></i></span><span class="pcoded-mtext">Products</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="{{route('products.create')}}">Add Product</a></li>
                        <li><a href="{{route('products.index')}}">Products List</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{route('orders')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layers"></i></span><span class="pcoded-mtext">Orders</span></a>
                </li>

            </ul>


        </div>
    </div>
</nav>
