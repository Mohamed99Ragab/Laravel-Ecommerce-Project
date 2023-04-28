<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class homeController extends Controller
{


    public function home(){


        $latestOrders = Order::latest()->take(6)->get();

        $totalSales = Order::where('status','Completed')->sum('total');

        $users = User::count();




        return view('home',compact('latestOrders','totalSales','users'));
    }


    public function clearNotify()
    {
        $admin = Admin::find(Auth::guard('admin')->id());

        $admin->notifications()->delete();

        return back();
    }

  public  function markAsReadNotification(){

        $admin = Admin::find(Auth::guard('admin')->id());

      foreach ($admin->unreadNotifications as $notification) {
          $notification->markAsRead();
      }


        }



}
