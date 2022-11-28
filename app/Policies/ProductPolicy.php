<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    public function allowUser(User $user){
        if($user->role == "0" || $user->role == "1"){
            return true;
        }
    }


    public function viewAny(User $user)
    {
        //
    }


    public function view(User $user, Product $product)
    {
        //
    }


    public function create(User $user)
    {
        //
    }


    public function update(User $user, Product $product)
    {
        //
    }


    public function delete(User $user, Product $product)
    {
        //
    }

    public function restore(User $user, Product $product)
    {
        //
    }


    public function forceDelete(User $user, Product $product)
    {
        //
    }
}
