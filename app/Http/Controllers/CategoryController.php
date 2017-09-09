<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only('show');
    }

    public function index()
    {
        $categories = Category::all();
        return view('categories.index',compact('categories'));
    }



    public function show(Category $category)
    {
        $category = $category->load('quizzes');
        return view('categories.show',compact('category'));
    }


}
