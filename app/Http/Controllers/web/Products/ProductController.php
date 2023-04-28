<?php

namespace App\Http\Controllers\web\Products;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::get();

        return view('products.index',compact('products'));
    }






    public function create()
    {

        $cats = Category::get();

        return view('products.add-product',compact('cats'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:200',
            'new_price'=>'required|numeric',
            'old_price'=>'numeric',
            'cat_id'=>'required|exists:categories,id',
            'quantity'=>'required|numeric',
            'product_img'=>'required|image',
            'desc'=>'required',

        ]);


        //        save product img
        $request->file('product_img')->store('products','public');

        Product::create([
            'name'=>$request->name,
            'new_price'=>$request->new_price,
            'old_price'=>$request->old_price,
            'category_id'=>$request->cat_id,
            'quantity'=>$request->quantity,
            'product_img'=>$request->file('product_img')->hashName(),
            'desc'=>$request->desc,
            'is_feature'=>$request->is_feature

        ]);



        session()->flash('success','Product Created Success');

        return redirect()->back();



    }


    public function show(Product $product)
    {
        //
    }


    public function edit($id)
    {

        $product = Product::findOrfail($id);
        $cats = Category::get();

        return view('products.edit-product',compact('product','cats'));

    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required|string|max:200',
            'new_price'=>'required|numeric',

            'cat_id'=>'required|exists:categories,id',
            'quantity'=>'required|numeric',
            'product_img'=>'image',
            'desc'=>'required',

        ]);


        $product = Product::find($id);



        if(isset($product))
        {

            if($request->file('product_img'))
            {
                Storage::disk('public')->delete('products/'.$product->product_img);

                $request->file('product_img')->store('products','public');

                $product->update([
                    'product_img'=>$request->file('product_img')->hashName()
                ]);

            }


            $product->update([
                'name'=>$request->name,
                'new_price'=>$request->new_price,
                'old_price'=>$request->old_price,
                'category_id'=>$request->cat_id,
                'quantity'=>$request->quantity,
                'desc'=>$request->desc,
                'is_feature'=>$request->is_feature
            ]);
        }



        session()->flash('success','Product Updated Success');

        return redirect()->route('products.index');



    }


    public function destroy($id)
    {
        $product = Product::findOrfail($id);

        if(isset($product)){

            Storage::disk('public')->delete('products/'.$product->product_img);

            $product->delete();

            session()->flash('success','Product deleted success');
            return redirect()->back();
        }
    }
}
