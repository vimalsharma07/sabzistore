<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Models\OrderReview;
use App\Http\Controllers\Controller; // Import the base Controller class


class ReviewController extends Controller
{
    /**
     * Store a new order review.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */

     public function showReviews()
     {
         // Fetch all reviews with their associated order and user data (if necessary)
         $reviews = OrderReview::with('order', 'user')->get();
     
         return view('frontend.components.orders.reviews', compact('reviews'));
     }
     public function reviewshow(Request $request , $id){
        $review = OrderReview::find($id);
        return view('frontend.components.orders.review', compact('review'));
    
    }
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'order_id' => 'required|integer|exists:orders,id',
            'user_id' => 'required|integer|exists:users,id',
            'rating' => 'required|integer|min:1|max:5',
            'feedback' => 'nullable|string|max:1000',
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB per photo
        ]);

        // Handle photo uploads
        $photoPaths = [];
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $filename = time() . '_' . uniqid() . '.' . $photo->getClientOriginalExtension();
                $photo->move(public_path('uploads/reviews'), $filename); // Move to public/uploads/reviews
                $photoPaths[] = 'uploads/reviews/' . $filename; // Save relative path
            }
        }

        // Save the review in the database
        $review = new OrderReview();
        $review->order_id = $request->order_id;
        $review->user_id = $request->user_id;
        $review->rating = $request->rating;
        $review->feedback = $request->feedback;
        $review->photos = json_encode($photoPaths);
        $review->save();

        // Return a success response
        return response()->json([
            'message' => 'Review submitted successfully!',
            'data' => $review,
        ]);
    }

    public function destroy($id)
{
    // Find the review by its ID
    $review = OrderReview::find($id);
    
    // Check if the review exists
    if ($review) {
        // Delete associated photos from the server (optional)
        if ($review->photos) {
            foreach (json_decode($review->photos) as $photo) {
                if (file_exists(public_path($photo))) {
                    unlink(public_path($photo));
                }
            }
        }

        // Delete the review from the database
        $review->delete();

        // Redirect back with a success message
        return redirect()->route('reviews.index')->with('success', 'Review deleted successfully.');
    }

    // If the review doesn't exist, redirect with an error message
    return redirect()->back()->with('error', 'Review not found.');
}



}
