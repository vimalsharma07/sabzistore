<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use DataTables;
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
    // dd($request->all());

    // Validate the incoming data
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'category_id' => 'required|integer|exists:categories,id',
        'description' => 'nullable|string',
        'image' => 'nullable|image|max:2048',
        
    ]);

    // Handle the main product image (thumbnail)
    $thumbnailImagePath = null;
    if ($request->hasFile('image')) {
        $thumbnailImage = $request->file('image');
        $thumbnailImageName = time() . '_' . $thumbnailImage->getClientOriginalName();
        // Move the file to public/assets/products/thumbnails
        $thumbnailImagePath = 'assets/products/thumbnails/' . $thumbnailImageName;;
        $thumbnailImage->move(public_path('assets/products/thumbnails'), $thumbnailImageName);
    }
    $slug = Str::slug($request->name);
    $slug = $slug . '-' . Str::random(5); 
        $attributes = [];
    if ($request->has('attributes')) {
        foreach ($request['attributes'] as $attribute) {
            if (isset($attribute['name']) && isset($attribute['value'])) {
                $attributes[$attribute['name']] = $attribute['value'];
            }
        }
    }
    // Create a new product
    $product = Product::create([
        'user_id' => auth()->id(), // assuming the user is logged in
        'name' => $request->name,
        'category_id' => $request->category_id,
        'subcategory_id' => $request->subcategory_id,
        'childcategory_id' => $request->childcategory_id,
        'description' => $request->description,
        'meta_title' => $request->meta_title,
        'meta_tags' => $request->meta_tags,
        'meta_description' => $request->meta_desc,
        'brand'=>$request->brand,
        'image' => $thumbnailImagePath,
        'slug'=> $slug,
        'attributes'=> json_encode($attributes),
        'price'=>$request->price,
        'mrp'=>$request->mrp,
        'attributes_mrp'=> json_encode($request->mrps),
    ]);

    // Handle gallery images (if any)
    if ($request->hasFile('gallery_images')) {
        foreach ($request->file('gallery_images') as $galleryImage) {
            $galleryImageName = time() . '_' . $galleryImage->getClientOriginalName();
            // Move the gallery image to public/assets/products/images
            $galleryImagePath = 'assets/products/images/' . $galleryImageName;
            $galleryImage->move(public_path('assets/products/images'), $galleryImageName);

            // Save each gallery image to the product_images table
            ProductImage::create([
                'product_id' => $product->id,
                'image' => $galleryImagePath,
            ]);
        }
    }

    // Redirect or return response
    return redirect()->route('products.index')->with('success', 'Product created successfully!');
}

public function index()
    {
        return view('admin.products.index');
    }

    // Fetch product data for DataTables
    public function getData(Request $request)
    {
        $products = Product::all();

        return DataTables::of($products)
            ->addColumn('action', function ($product) {
                return '
                    <a href="' . route('products.edit', $product->id) . '" class="btn btn-sm btn-primary">Edit</a>
                    <button class="btn btn-sm btn-danger delete-btn" data-id="' . $product->id . '">Delete</button>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    // Delete a product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['success' => 'Product deleted successfully']);
    }

    public function edit($id)
    {
        // Find the product by ID
        $product = Product::findOrFail($id);

        // Fetch categories for dropdown
        $categories = Category::all();

        // Return the edit view with the product and categories
        return view('admin.products.edit', compact('product', 'categories'));
    }


    public function update(Request $request, $id)
    {
        // Validate the incoming data
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'subcategory_id' => 'nullable|integer',
            'childcategory_id' => 'nullable|integer',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'tags' => 'nullable|string',
            'meta_title' => 'nullable|string',
            'meta_tags' => 'nullable|string',
            'meta_desc' => 'nullable|string',
            'attributes' => 'nullable|array',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Find the product by ID
        $product = Product::findOrFail($id);

        // Update product details
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->childcategory_id = $request->childcategory_id;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->tags = $request->tags;
        $product->meta_title = $request->meta_title;
        $product->meta_tags = $request->meta_tags;
        $product->meta_description = $request->meta_desc;
        $product->mrp = $request->mrp;
        // Handle attributes
        if ($request->has('attributes')) {
            $attributes = [];
            foreach ($request['attributes'] as $attribute) {
                if (!empty($attribute['name']) && !empty($attribute['value'])) {
                    $attributes[$attribute['name']] = $attribute['value'];
                }
            }
            $product->attributes = json_encode($attributes);
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('assets/products/images'), $imageName);
            $product->image = $imageName;
        }

        // Save the product
        $product->save();

        // Redirect back with success message
        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }
}
