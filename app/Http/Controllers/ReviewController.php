<?php

namespace App\Http\Controllers;

use ErrorException;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Place;
use Tymon\JWTAuth\Facades\JWTAuth;
class ReviewController extends Controller
{
    //

    public function store(Request $request, $placeId){
        
        try {
            $place = Place::find($placeId);
            $place["avg_rating"] = ($place["avg_rating"]
             * count($place["reviews"]) + $request->rating) /
             (count($place["reviews"])+ 1);

             //use Tymon\JWTAuth\Facades\JWTAuth;

             $user= JWTAuth::parseToken()->authenticate();
             $userId = $user->id;
/// This should be done inside a DB Transaction

// start transaction
        Review::create([
            "rating"=>$request->rating,
            "user_id"=>$userId,
            "place_id"=>$placeId,
            "comments"=>$request->comments
        ]);

        $place->save();
        /// commit transaction



       return  response()->json(["success"=>true, 
        "message"=>"Review successfully added"]);
    }
    catch (\Exception $e){
        return response()->json(['error' => 'Add Review failed ' . $e], 500);
        // rollback transaction


    }

    }

    
}
