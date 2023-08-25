<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Review;
use App\Models\Place;

class ReviewController extends Controller
{
    //

    public function store(Request $request,$id){

        try {
        $user = JWTAuth::parseToken()->authenticate();
        $userId = $user->id;

        $place = Place::with('reviews')->where('id',$id)->first();
      
        $place["avg_rating"]= ($place["avg_rating"]* count($place["reviews"]) + $request->rating) / ( count($place["reviews"]) +1);
       
        Review::create([
            "user_id"=>$userId,
            "place_id"=>$id,
            "rating"=>$request->rating,
            "comments"=>$request->comments
        ]);

        $place->save();
        return response()->json(["message"=>"Review successfully added",
        "success"=>true
    ]);
}
catch (\Exception $e) {
    return response()->json(['error' => 'Add review failed ' . $e], 500);
}

        

      




    }
}
