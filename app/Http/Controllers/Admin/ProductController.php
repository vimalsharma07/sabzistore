<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;

use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function add(){
     $category=  Category::where('status',1)->get();
        return view('admin.products.create',['categories'=>$category]);
    }


    public function store(Request $request)
{
    dd($request->all());
    // Validate the incoming data
    // $validated = $request->validate([
    //     'name' => 'required|string|max:255',
    //     'category_id' => 'required|integer|exists:categories,id',
    //     'subcategory_id' => 'nullable|integer|exists:subcategories,id',
    //     'childcategory_id' => 'nullable|integer|exists:childcategories,id',
    //     'description' => 'nullable|string',
    //     'meta_title' => 'nullable|string|max:255',
    //     'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //     'gallery_images' => 'nullable|array',
    //     'gallery_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    // ]);

    // Handle the main product image (thumbnail)
    $thumbnailImagePath = null;
    if ($request->hasFile('image')) {
        $thumbnailImage = $request->file('image');
        $thumbnailImageName = time() . '_' . $thumbnailImage->getClientOriginalName();
        // Move the file to public/assets/products/thumbnails
        $thumbnailImagePath = public_path('assets/products/thumbnails/' . $thumbnailImageName);
        $thumbnailImage->move(public_path('assets/products/thumbnails'), $thumbnailImageName);
    }
    $slug = Str::slug($request->name);
    $slug = $slug . '-' . Str::random(5); 
    // Create a new product
    $product = Product::create([
        'user_id' => auth()->id(), // assuming the user is logged in
        'name' => $request->name,
        'category_id' => $request->category_id,
        'subcategory_id' => $request->subcategory_id,
        'childcategory_id' => $request->childcategory_id,
        'description' => $request->description,
        'meta_title' => $request->meta_title,
        'image' => $thumbnailImagePath,
        'slug'=> $slug,
    ]);

    // Handle gallery images (if any)
    if ($request->hasFile('gallery_images')) {
        foreach ($request->file('gallery_images') as $galleryImage) {
            $galleryImageName = time() . '_' . $galleryImage->getClientOriginalName();
            // Move the gallery image to public/assets/products/images
            $galleryImagePath = public_path('assets/products/images/' . $galleryImageName);
            $galleryImage->move(public_path('assets/products/images'), $galleryImageName);

            // Save each gallery image to the product_images table
            ProductImage::create([
                'product_id' => $product->id,
                'image_path' => $galleryImagePath,
            ]);
        }
    }

    // Redirect or return response
    return redirect()->route('products.index')->with('success', 'Product created successfully!');
}
}
