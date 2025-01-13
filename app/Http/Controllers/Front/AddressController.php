<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Address;
use Auth;

class AddressController extends Controller
{
    public function index(){
      $addressess=   Address::where('user_id', Auth::user()->id)->get();
      return view ('frontend.user.alladdress',['addresses'=>$addressess]);

    }
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

        return redirect()->route('order.create');
    }


    public function edit($id)
    {
        $address = Address::findOrFail($id);
        return view('frontend.user.editaddress', compact('address'));
    }

    public function update(Request $request, $id)
    {
        $address = Address::findOrFail($id);
        $address->update($request->all());
        return redirect()->route('addresses.index')->with('success', 'Address updated successfully.');
    }

    public function destroy($id)
    {
        $address = Address::findOrFail($id);
        $address->delete();
        return redirect()->route('addresses.index')->with('success', 'Address deleted successfully.');
    }
}
