<?php

namespace App\Policies;

use App\Models\User;
use App\Models\subCategory;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubCategoryPolicy
{
    use HandlesAuthorization;


    public function allowUser(User $user){
        if($user->role == "0" || $user->role == "1"){
            return true;
        }
    }


    public function viewAny(User $user)
    {

    }


    public function view(User $user, subCategory $subCategory)
    {

    }


    public function create(User $user)
    {

    }


    public function update(User $user, subCategory $subCategory)
    {

    }

    public function delete(User $user, subCategory $subCategory)
    {

    }


    public function restore(User $user, subCategory $subCategory)
    {

    }


    public function forceDelete(User $user, subCategory $subCategory)
    {

    }
}
