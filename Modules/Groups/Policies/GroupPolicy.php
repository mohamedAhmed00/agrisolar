<?php

namespace Modules\Groups\Policies;

use Modules\Users\Entities\User;
use Modules\Groups\Entities\Group;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the group.
     *
     * @return mixed
     */
    public function view()
    {
        return User::find(auth()->user()->id)->Group->permission->show_groups == 'true';
    }

    /**
     * Determine whether the user can create groups.
     *
     * @return mixed
     */
    public function create()
    {
        return User::find(auth()->user()->id)->Group->permission->create_groups == 'true';
    }

    /**
     * Determine whether the user can update the group.
     *
     * @return mixed
     */
    public function update()
    {
        return User::find(auth()->user()->id)->Group->permission->edit_groups == 'true';
    }

    /**
     * Determine whether the user can delete the group.
     *
     * @return mixed
     */
    public function delete()
    {
        return User::find(auth()->user()->id)->Group->permission->delete_groups == 'true';
    }

    /**
     * Determine whether the user can restore the group.
     *
     * @param  \App\User  $user
     * @param  \App\Group  $group
     * @return mixed
     */
    public function restore(User $user, Group $group)
    {
    }

    /**
     * Determine whether the user can permanently delete the group.
     *
     * @param  \App\User  $user
     * @param  \App\Group  $group
     * @return mixed
     */
    public function forceDelete(User $user, Group $group)
    {
        //
    }
}
