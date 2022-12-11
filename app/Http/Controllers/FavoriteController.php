<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFavouriteRequest;
use App\Http\Requests\UpdateFavouriteRequest;
use App\Http\Resources\FavoriteResource;
use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use mysql_xdevapi\Collection;

class FavoriteController extends Controller
{
    public function index()
    {
        if(Gate::allows('allowUser',Favorite::class)){
            $favourites = Favorite::latest('id')->paginate(5)->withQueryString();
        }else{
            $favourites = Favorite::where('user_id', Auth::id())->latest('id')->paginate(5)->withQueryString();
        }

        return FavoriteResource::collection($favourites);
    }

    public function store(StoreFavouriteRequest $request)
    {
        $favourite = new Favorite();
        $favourite->user_id = Auth::id();
        $favourite->product_id = $request->product_id;
        $favourite->save();

        return response()->json(['success' => true, 'message' => 'added to favourite', 'data' => new FavoriteResource($favourite)]);
    }

    public function show($id)
    {
        $favourite = Favorite::find($id);
        if(is_null($favourite)){
            return response()->json(['message'=>'favourite not found']);
        }
        return new FavoriteResource($favourite);
    }



    public function destroy($id)
    {
        $favourite = Favorite::find($id);
        if(is_null($favourite)){
            return response()->json(['message'=>'favourite not found']);
        }
        $favourite->delete();
        return response()->json(['success' => true,'message' => 'remove from a favourite'], 200);
    }
}
