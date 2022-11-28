<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function scopeSearch($query){
        return $query->when(request('search'), function($q){
            $search = request('search');
            $q->orWhere("name","like","%$search%")
                ->orWhere("description","like","%$search%")
                ->orWhereBetween("price",[$search]);
        });
    }
}
