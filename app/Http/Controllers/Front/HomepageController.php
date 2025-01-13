<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class HomepageController extends Controller
{
    public function index(Request $request){
    $products = Product::where('status',1)->get();

     $popular_products = Product::where('status',1)->where('popular',1)->get();
     $trending_products = Product::where('status',1)->where('trending',1)->get();

     return view('frontend.index',['products'=>$products,'popular_products'=>$popular_products,'trending_products'=>$trending_products]);
    }

    public function about(){
        return view('frontend.aboutus');
    }

    public function search(Request $request) {
        $searchQuery = $request->input('q');
    
        $products = Product::where('name', 'LIKE', "%{$searchQuery}%")
            ->orWhere('description', 'LIKE', "%{$searchQuery}%")
            ->orWhere('meta_title', 'LIKE', "%{$searchQuery}%")
            ->orWhere('meta_tags', 'LIKE', "%{$searchQuery}%")
            ->orWhere('tags', 'LIKE', "%{$searchQuery}%")
            ->orWhere('brand', 'LIKE', "%{$searchQuery}%")
            ->orWhere('attributes', 'LIKE', "%{$searchQuery}%")
            ->orWhere('health', 'LIKE', "%{$searchQuery}%")
            ->get();
    
            return view('frontend.index',['products'=>$products]);
        }
    
}
