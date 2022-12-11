<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{

    /*public function __construct()
    {
        if(Gate::denies("allowUser",User::class)){
            return response()->json(["message" => "user was not allowed"]);
        };
    }*/

    public function index()
    {
        $users = User::search()->latest('id')->paginate(2)->withQueryString();
        return UserResource::collection($users);
    }



    public function store(Request $request)
    {
        //
    }



    public function show($id)
    {
        if(Gate::denies("allowUser",User::class)){
            return response()->json(["message" => "user was not allowed"]);
        };

        $user = User::find($id);
        if(is_null($user)){
            return response()->json(["message"=>"user not found"]);
        }
        return new UserResource($user);
    }




    public function update(Request $request, $id)
    {
        if(Gate::denies("allowUser",User::class)){
            return response()->json(["message" => "user was not allowed", 404]);
        };

        $user = User::find($id);
        if(is_null($user)){
            return response()->json(["message" => "user not found"], 404);
        }

        if(isset($request->banned)){
            $user->banned = $request->banned;
            $user->update();

            $userBannedMessage = "";
            if($user->banned == "0"){
                $userBannedMessage = "user was released";
            }else if ($user->banned == "1"){
                $userBannedMessage = "user was warning";
            }else if($user->banned == "2"){
                $userBannedMessage = "user was banned";
            }

            return response()->json(["user" => new UserResource($user), "message" => $userBannedMessage]);
        }

        if(isset($request->role)){
            $user->role = $request->role;
            $user->update();

            $userRoleMessage = "";
            if($user->role == 0){
                $userRoleMessage = "user was changed to admin";
            }else if ($user->role == 1){
                $userRoleMessage = "user was changed to the editor";
            }else if($user->role == 2){
                $userRoleMessage = "user was changed to the user";
            }

            return response()->json(['user' => new UserResource($user), 'message' => $userRoleMessage]);
        }

    }



    public function destroy($id)
    {
        if(Gate::denies('allowUser',User::class)){
            return response()->json(['message' => 'user was not allowed']);
        };

        $user = User::find($id);
        if(is_null($user)){
            return response()->json(['message'=> 'user not found'], 404);
        }
        $user->delete();
        return response()->json(
            [
                'success' => true,
                'message' => 'user was deleted' ,
            ],200
        );
    }

}
