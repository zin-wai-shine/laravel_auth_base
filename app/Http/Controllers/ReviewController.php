<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ReviewResource;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{

    public function index()
    {
        $reviews = Review::latest('id')->paginate(7)->withQueryString();
        return ReviewResource::collection($reviews);
    }

    public function store(StoreReviewRequest $request)
    {
        # when user was selected the first time trigger with store;
        # if user was changed their selected revert to update;
        $review = new Review();
        $review->rate = $request->rate;
        $review->user_id = Auth::id();
        $review->product_id = $request->product_id;
        $review->save();
        return response()->json(
            [
                'success' => true,
                'message' => 'thanks for your interesting' ,
            ]
        );
    }

    public function show($id)
    {
        $review = Review::find($id);
        if(is_null($review)){
            return response()->json(['message'=>'review not found']);
        }
        return new ReviewResource($review);
    }

    public function update(UpdateReviewRequest $request, $id)
    {
        # only the first time is store;
        # the first time user was selected review, they don't like their selected and they change their selected return to update;
        $review = Review::find($id);
        if(is_null($review)){
            return response()->json(['message'=>'review not found']);
        }
        $review->rate = $request->rate;
        $review->update();

        return response()->json(
            [
                'success' => true,
                'message' => 'thanks for your interesting' ,
            ]
        );
    }

    public function destroy($id)
    {
        // user was selected the review, if user don't want selected and return blank deleted that review in review table;
        $review = Review::find($id);
        if(is_null($review)){
            return response()->json(['message'=>'review not found']);
        }
        $review->delete();
        return response()->json(
            [
                'success' => true,
                'message' => 'review was removed' ,
            ]
        );
    }
}
