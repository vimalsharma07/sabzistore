<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Models\OrderReview;

class OrderReviewController extends Controller
{
    /**
     * Store a new order review.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
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
}
