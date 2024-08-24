<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReplyRequest;
use App\Models\Reply;
use App\Models\Review;
use Illuminate\Http\Request;

class ReplyController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReplyRequest $request, $reviewId)
    {
        $data = $request->validated();

        $review = Review::findOrFail($reviewId);

        $reply = Reply::create([
            'review_id' => $review->id,
            'user_id' => auth()->id(),
            'content' => $data['content'],
        ]);

        return response()->json($reply, 201);
    }
}
