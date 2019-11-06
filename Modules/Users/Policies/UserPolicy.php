<?php

namespace Modules\Users\Policies;

use Modules\Users\Entities\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     * @return mixed
     */
    public function view()
    {
        return User::find(auth()->user()->id)->Group->permission->show_user == 'true';
    }

    /**
     * Determine whether the user can create models.
     * @return mixed
     */
    public function create()
    {
        return User::find(auth()->user()->id)->Group->permission->create_user == 'true';
    }

    /**
     * Determine whether the user can update the model.
     * @return mixed
     */
    public function update()
    {
        return User::find(auth()->user()->id)->Group->permission->edit_user == 'true';
    }

    /**
     * Determine whether the user can delete the model.
     * @return mixed
     */
    public function delete()
    {
        return User::find(auth()->user()->id)->Group->permission->delete_user == 'true';
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function restore(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function forceDelete(User $user, User $model)
    {
        //
    }
}
