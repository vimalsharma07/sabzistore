<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Address;

class AddressController extends Controller
{
    public function create(){
        return view ('frontend.user.addaddress');
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'houseno' => 'required|string|max:255',
            'appartment' => 'nullable|string|max:255',
            'address' => 'required|string|max:255',
            'landmark' => 'nullable|string|max:255',
            'lat' => 'nullable|numeric',
            'lang' => 'nullable|numeric',
        ]);

        Address::create([
            'user_id' => auth()->id(), // Assuming the user is authenticated
            'houseno' => $validated['houseno'],
            'appartment' => $validated['appartment'],
            'address' => $validated['address'],
            'landmark' => $validated['landmark'],
            'lat' => $validated['lat'],
            'lang' => $validated['lang'],
        ]);

        return redirect()->route('address.create')->with('success', 'Address added successfully!');
    }
}
