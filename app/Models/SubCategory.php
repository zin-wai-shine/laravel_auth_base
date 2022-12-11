<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    public function scopeSearch($query){
        return $query->when(request('search'), function($q){
            $search = request('search');
            $q->where("name","like","%$search%");
        });
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
