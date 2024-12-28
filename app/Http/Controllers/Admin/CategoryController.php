<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{

 public function index(Request $request){
 $categories =   Category::where('status',1)->get();

 return view('admin.category.index',['categories'=>$categories]);

 }
  public function add(){
     return view('admin.category.create');
  }


  public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'status' => 'required|in:0,1',
        'slug' => 'required|string|unique:categories,slug|max:255',
    ]);

    Category::create($validated);

    return redirect()->back()->with('success', 'Category created successfully!');
}

}
