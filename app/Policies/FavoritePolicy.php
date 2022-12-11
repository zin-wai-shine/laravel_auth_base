<?php

namespace App\Policies;

use App\Models\Favorite;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FavoritePolicy
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

    public function view(User $user, Favorite $favourite)
    {
        //
    }

    public function create(User $user)
    {
        //
    }


    public function update(User $user, Favorite $favourite)
    {
        //
    }


    public function delete(User $user, Favorite $favourite)
    {
        //
    }


    public function restore(User $user, Favorite $favourite)
    {
        //
    }


    public function forceDelete(User $user, Favorite $favourite)
    {
        //
    }
}
