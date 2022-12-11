<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;

class ElseStatusController extends Controller
{
    public function updateDeletePhotos(Request $request){
        if($request->update_photos){
            Photo::destroy($request->update_photos);
        }
    }
}
