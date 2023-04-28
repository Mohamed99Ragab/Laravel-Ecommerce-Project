<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\HttpResponse;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    use HttpResponse;


    public  function getAllBanners(){

        $banners = Banner::all();
        foreach ($banners as $banner){

            $banner->img_banner = asset('Imgs/banners/'.$banner->img_banner);
        }

        return $this->responseJson($banners,null,true);

    }
}
