<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
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

    public function view(User $user, Category $category)
    {
        //
    }

    public function create(User $user)
    {

    }

    public function update(User $user, Category $category)
    {

    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Category $category)
    {
        //
    }

    public function restore(User $user, Category $category)
    {
        //
    }

    public function forceDelete(User $user, Category $category)
    {
        //
    }
}
