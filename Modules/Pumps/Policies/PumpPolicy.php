<?php

namespace Modules\Pumps\Policies;

use Modules\Users\Entities\User;
use Modules\Pumps\Entities\Pump;
use Illuminate\Auth\Access\HandlesAuthorization;

class PumpPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the pump.
     *
     * @return mixed
     */
    public function view()
    {
        return true;
        return User::find(auth()->user()->id)->Group->permission->show_pump == 'true';
    }

    /**
     * Determine whether the user can create pumps.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create()
    {
        return User::find(auth()->user()->id)->Group->permission->create_pump == 'true';
    }

    /**
     * Determine whether the user can update the pump.
     *
     * @param  \App\User  $user
     * @param  \App\Pump  $pump
     * @return mixed
     */
    public function update()
    {
        return User::find(auth()->user()->id)->Group->permission->edit_pump == 'true';
    }

    /**
     * Determine whether the user can delete the pump.
     *
     * @param  \App\User  $user
     * @param  \App\Pump  $pump
     * @return mixed
     */
    public function delete()
    {
        return User::find(auth()->user()->id)->Group->permission->delete_pump == 'true';
    }

    /**
     * Determine whether the user can restore the pump.
     *
     * @param  \App\User  $user
     * @param  \App\Pump  $pump
     * @return mixed
     */
    public function restore(User $user, Pump $pump)
    {
    }

    /**
     * Determine whether the user can permanently delete the pump.
     *
     * @param  \App\User  $user
     * @param  \App\Pump  $pump
     * @return mixed
     */
    public function forceDelete(User $user, Pump $pump)
    {
        //
    }
}
