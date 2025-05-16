<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Category $category){
        if(isset($category->parent_id))
            $ads = $category->ads()->paginate(10);
        else
            $ads = $category->subAds()->paginate(10);
        return view('categories.show',["category" => $category,"ads" => $ads]);
    }
    
    public function list(){
        $categories = Category::whereNull('parent_id')->with('subCategories')->get();
        return view('categories.list',['categories' => $categories]);
    }
}
