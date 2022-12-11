<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function scopeSearch($query){
       if(request('search')){
           return $query->when(request('search'), function($q){
               $search = request('search');
               $q->orWhere("name","like","%$search%")
                   ->orWhere("description","like","%$search%");
           });
       }else if(request('search_by_price')){
           return $query->when(request('search_by_price'), function($q){
               $searchPrice = json_decode(request('search_by_price'));
               $q->where('price','>=',$searchPrice[0])->where('price','<=',$searchPrice[1]);
           });
       }
    }


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function subCategory(){
        return $this->belongsTo(SubCategory::class);
    }

    public function photos(){
        return $this->hasMany(Photo::class);
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }
}
