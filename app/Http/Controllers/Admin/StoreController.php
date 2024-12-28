<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;
use Auth;
use DataTables;

class StoreController extends Controller
{
     // Display the form for creating a new store
     public function create()
     {
         return view('admin.stores.create');
     }
 
     // Store a new store in the database
     public function store(Request $request)
     {
        // dd($request->all());
         // Validate the incoming data
         $validatedData = $request->validate([
            'name'      => 'required|string|max:255',
            'address'   => 'required|string|max:255',
            'slug'      => 'nullable|string|max:255',
        ]);
 
         $data = $request->except('_token'); // Exclude CSRF token from request
         $data['user_id'] =Auth::user()->id;
         Store::create($data); 
         return redirect()->route('stores.index')->with('success', 'Store created successfully');
     }
 
     // Show the form for editing an existing store
     public function edit($id)
     {
         $store = Store::findOrFail($id); // Retrieve the store by ID
         return view('admin.stores.edit', compact('store'));
     }
 
     // Update an existing store in the database
     public function update(Request $request, $id)
     {
         // Validate the incoming data
         $validatedData = $request->validate([
             'name'      => 'required|string|max:255',
             'address'   => 'required|string|max:255',
             'slug'      => 'nullable|string|max:255',
         ]);
 
         // Find the store by ID
         $store = Store::findOrFail($id);
         $data= $request->except('_token');
         // Update the store details
         $store->update($data);
 
         return redirect()->route('stores.index')->with('success', 'Store updated successfully');
     }
 
     // Display a list of all stores
     public function index()
     {
         $stores = Store::all(); // Fetch all stores
         return view('admin.stores.index', compact('stores'));
     }

     public function getStores()
     {
         try {
             $stores = Store::select(['id', 'name', 'address', 'latitude', 'longitude', 'status']);
             
             return DataTables::of($stores)
                 ->addColumn('action', function ($store) {
                     return '
                         <a href="/admin/stores/' . $store->id . '/edit" class="btn btn-warning btn-sm">Edit</a>
                         <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="' . $store->id . '">Delete</button>
                     ';
                 })
                 ->rawColumns(['action']) // Allows HTML in the 'action' column
                 ->make(true);
         } catch (\Exception $e) {
             // Log the error for debugging
             \Log::error('Error in getStores: ' . $e->getMessage());
             return response()->json(['error' => 'Something went wrong!'], 500);
         }
     }
     
     

public function destroy($id)
{
    $store = Store::findOrFail($id);
    $store->delete();  // Delete the store

    return response()->json(['success' => 'Store deleted successfully']);
}

}
