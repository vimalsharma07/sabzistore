<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Media;

class MediaController extends Controller
{

    public function edit(Request $request){
        $media=  Media::first();
        return view('admin.media.edit',['media'=>$media]);
     }

public function update(Request $request, $id)
{
    $media = Media::findOrFail($id);

    $validatedData = $request->validate([
        'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'address' => 'nullable|string|max:255',
        'whatsapp' => 'nullable|string|max:20',
        'facebook' => 'nullable|string|max:255',
        'instagram' => 'nullable|string|max:255',
        'twitter' => 'nullable|string|max:255',
        'mobile' => 'nullable|string|max:15',
    ]);

   // Handle logo upload
   if ($request->hasFile('logo')) {
    $oldLogoPath = public_path('uploads/media/' . $media->logo);

    // Delete old logo if it exists
    if ($media->logo && file_exists($oldLogoPath)) {
        unlink($oldLogoPath);
    }

    // Save new logo
    $logo = $request->file('logo');
    $logoName = time() . '_' . $logo->getClientOriginalName();
    $logoPath = public_path('uploads/media/' . $logoName);

    // Move the uploaded file to the desired directory
    $logo->move(public_path('uploads/media'), $logoName);

    // Store the full path in the database
    $validatedData['logo'] = $logoPath;

}

// Update other fields
$media->update($validatedData);

return redirect()->back()->with('success', 'Media updated successfully.');

}


}