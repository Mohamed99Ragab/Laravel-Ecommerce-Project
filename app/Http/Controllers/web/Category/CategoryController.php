<?php

namespace App\Http\Controllers\web\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{

    public function index()
    {

        $cats = Category::all();
        return view('categories.index',compact('cats'));
    }


    public function create()
    {
        dd('welcome');
    }


    public function store(Request $request)
    {

//        return $request->file('file');
        $request->validate([
            'name'=>'required|string',
            'file'=>'required|image'
        ]);



        $path = $request->file('file')->hashName();

        Category::create([
            'name'=>$request->name,
            'cat_img'=>$path
        ]);

        $request->file('file')->store('categories','public');

        session()->flash('success','data save success');

        return redirect()->back();


    }


    public function show(Category $category)
    {
        //
    }


    public function edit(Category $category)
    {
        //
    }


    public function update(Request $request, $id)
    {
        $cat = Category::findOrfail($id);

        $cat->update([
            'name'=>$request->name
        ]);

        if($request->file('file'))
        {
            Storage::disk('public')->delete('categories/'.$cat->cat_img);

            $request->file('file')->store('categories','public');

            $cat->update([
                'cat_img'=>$request->file('file')->hashName()
            ]);



        }

        session()->flash('success','data save success');

        return redirect()->back();



    }


    public function destroy($id)
    {
        $cat = Category::findOrfail($id);

        if(isset($cat)){

            Storage::disk('public')->delete('categories/'.$cat->cat_img);

            $cat->delete();

            session()->flash('success','Category deleted success');
            return redirect()->back();
        }

    }
}
