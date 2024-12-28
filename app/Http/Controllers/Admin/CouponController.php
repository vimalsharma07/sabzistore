<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;

class CouponController extends Controller
{
     // Display the coupon index page
     public function index()
     {
         return view('admin.coupons.index');
     }
 
     // Fetch coupons data for DataTables
     public function getCoupons(Request $request)
     {
         $coupons = Coupon::select(['id', 'name', 'code', 'slug', 'status', 'start_date', 'end_date', 'type'])
                          ->get();
     
         return datatables()->of($coupons)
             ->addColumn('action', function ($coupon) {
                 return view('admin.coupons.actions', compact('coupon'));
             })
             ->make(true);
     }
     

 
     // Show the form to create a new coupon
     public function create()
     {
         return view('admin.coupons.create');
     }
 
     // Store a new coupon
     public function store(Request $request)
     {
         $validatedData = $request->validate([
             'name' => 'nullable|string|max:255',
             'code' => 'required|string|max:50|unique:coupons,code',
             'slug' => 'nullable|string|max:255',
             'status' => 'required|in:0,1',
             'start_date' => 'required|date',
             'end_date' => 'required|date',
             'type' => 'required|in:p,r',
             'desc' => 'nullable|string',
             'brands' => 'nullable|string',
             'products' => 'nullable|string',
             'users' => 'nullable|string',
             'min_value'=>'required',
         ]);
 
         Coupon::create($validatedData);
         return redirect()->route('coupons.index')->with('success', 'Coupon created successfully.');
     }
 
     // Show the form to edit a coupon
     public function edit(Coupon $coupon)
     {
         return view('admin.coupons.edit', compact('coupon'));
     }
 
     // Update the coupon
     public function update(Request $request, Coupon $coupon)
     {
         $validatedData = $request->validate([
             'name' => 'nullable|string|max:255',
             'code' => 'required|string|max:50|unique:coupons,code,' . $coupon->id,
             'slug' => 'nullable|string|max:255',
             'status' => 'required|in:0,1',
             'start_date' => 'required|date',
             'end_date' => 'required|date',
             'type' => 'required|in:p,r',
             'desc' => 'nullable|string',
             'brands' => 'nullable|string',
             'products' => 'nullable|string',
             'users' => 'nullable|string',
             'value'=>'required',
             'min_value'=>'required',
         ]);
 
         $coupon->update($validatedData);
         return redirect()->route('coupons.index')->with('success', 'Coupon updated successfully.');
     }
 
     // Delete a coupon
     public function destroy(Coupon $coupon)
     {
         $coupon->delete();
         return response()->json(['success' => 'Coupon deleted successfully']);
     }
}
