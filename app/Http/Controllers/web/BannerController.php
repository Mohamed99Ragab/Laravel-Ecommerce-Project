<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{

    public function index()
    {
        $banners = Banner::get();


        return view('banner.index',compact('banners'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {

        $request->validate([
            'img_banner'=>'required|image'
        ]);



        // save img banner on server
        $request->file('img_banner')->store('banners','public');

        Banner::create([
            'title'=>$request->title,
            'offer'=>$request->offer,
            'img_banner'=>$request->file('img_banner')->hashName()

        ]);


        session()->flash('success','banner added success');

        return redirect()->back();
    }


    public function show(Banner $banner)
    {
        //
    }


    public function edit(Banner $banner)
    {
        //
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'img_banner'=>'image'
        ]);

        $banner = Banner::find($id);

        if(isset($banner) && !empty($banner)){

            if($request->file('img_banner')){

                //delete old img from server
                Storage::disk('public')->delete('banners/'.$banner->img_banner);

                // save new banner img
                $request->file('img_banner')->store('/banners','public');
            }

            $banner->update([
                'title'=>$request->title,
                'offer'=>$request->offer,
                'img_banner'=>$request->file('img_banner')?$request->file('img_banner')->hashName():$banner->img_banner

            ]);
        }



        session()->flash('success','banner edit success');

        return redirect()->back();
    }


    public function destroy($id)
    {
        $banner = Banner::findOrfail($id);

        if(isset($banner)){

            Storage::disk('public')->delete('banners/'.$banner->img_banner);

            $banner->delete();

            session()->flash('success','banner deleted success');
            return redirect()->back();
        }
    }
}
