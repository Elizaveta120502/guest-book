<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Http\Resources\ReviewResource;
use App\Models\Review;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with('replies')->paginate(10);

        return ReviewResource::collection($reviews);
    }

    public function store(ReviewRequest $request)
    {
       $data = $request->validated();

        $review = Review::create([
            'user_id' => auth()->id(),
            'content' => $data['content'],
        ]);

        return response()->json($review, 201);
    }
}
