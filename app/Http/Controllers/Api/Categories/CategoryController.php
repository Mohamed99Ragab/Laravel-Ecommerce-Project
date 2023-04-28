<?php

namespace App\Http\Controllers\Api\Categories;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Traits\HttpResponse;
use App\Models\Category;
use Illuminate\Http\Request;
use mysql_xdevapi\Collection;

class CategoryController extends Controller
{

    use HttpResponse;

    public function index()
    {
        $cats = Category::get();

        if(isset($cats) && $cats->count() > 0)
        {
            return $this->responseJson(CategoryResource::collection($cats),null,true);

        }

        return $this->responseJson(null,null,false);

    }




}
