<header class="navbar pcoded-header navbar-expand-lg navbar-light header-blue">


    <div class="m-header">
        <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
        <a href="#!" class="b-brand">
            <!-- ========   change your logo hear   ============ -->
{{--            <img src="{{asset('admin/assets/images/logo.png')}}" alt="" class="logo">--}}
                <h3 class="text-white">ELGWILE</h3>
        </a>
        <a href="#!" class="mob-toggler">
            <i class="feather icon-more-vertical"></i>
        </a>
    </div>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav me-auto">
            <li class="nav-item">
                <a href="#!" class="pop-search"><i class="feather icon-search"></i></a>
                <div class="search-bar">
                    <input type="text" class="form-control border-0 shadow-none" placeholder="Search hear">
                    <button type="button" class="close close btn-close position-absolute top-50 end-0 translate-middle" aria-label="Close">
                    </button>
                </div>
            </li>
        </ul>
        <ul class="navbar-nav ms-auto">
            <li>
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" data-bs-toggle="dropdown"><span class="p-1 bg-white rounded text-dark">{{auth()->guard('admin')->user()->unreadNotifications->count()}}</span><i class="icon feather icon-bell"></i></a>
                    <div class="dropdown-menu dropdown-menu-end notification">
                        <div class="noti-head">
                            <h6 class="d-inline-block m-b-0">Notifications</h6>
                            <div class="float-end">
{{--                                <a href="{{url('markRead')}}" class="m-r-10">mark as read</a>--}}
                                <a href="{{url('clearNotify')}}">clear all</a>
                            </div>
                        </div>
                        <ul class="noti-body">
                            <li class="n-title">
                                <p class="m-b-0">NEW</p>
                            </li>
                            @php
                                $admin = \App\Models\Admin::find(\Illuminate\Support\Facades\Auth::guard('admin')->id());

                            @endphp
                            @forelse($admin->Notifications as $notification)
                            <li class="notification">
                                <div class="d-flex">
                                    @if($notification->type =='App\Notifications\stockProductNotification')
                                    <img style="max-width: 50px;max-height: 50px" class="img-radius" src="{{asset('assets/alarm.png')}}" alt="Generic placeholder image">

                                    @elseif($notification->type=='App\Notifications\makeOrderNotification')
                                        <img class="img-radius" src="{{asset('assets/cart.png')}}" alt="Generic placeholder image">

                                    @endif

                                    <div class="flex-grow-1">
                                        @if($notification->type =='App\Notifications\stockProductNotification')
                                            <a href="{{route('products.edit',[$notification->data['product_id']])}}"><h6><strong>{{$notification->data['title']}}</strong></h6></a>

                                        @elseif($notification->type=='App\Notifications\makeOrderNotification')
                                            <a href="{{url('invoice',[$notification->data['order_id']])}}"><h6><strong>{{$notification->data['title']}}</strong></h6></a>

                                        @endif
                                        <p>{{$notification->data['body']}}</p>
                                    </div>
                                </div>
                            </li>

                            @empty
                                <li class="notification">
                                    no notification arrived yet.
                                </li>

                            @endforelse
                        </ul>
                        <div class="noti-footer">
                            <a href="#!">show all</a>
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <div class="dropdown drp-user">
                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="feather icon-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end profile-notification">
                        <div class="pro-head">
                            <img src="{{asset('Imgs/admins/'.auth()->guard('admin')->user()->photo)}}" class="img-radius" alt="User-Profile-Image">
                            <span>{{auth()->guard('admin')->user()->name}}</span>
                            <a href="{{route('logout')}}" class="dud-logout" title="Logout">
                                <i class="feather icon-log-out"></i>
                            </a>
                        </div>
                        <ul class="pro-body">
                            <li><a href="{{route('profile')}}" class="dropdown-item"><i class="feather icon-user"></i> Profile</a></li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>


</header>
