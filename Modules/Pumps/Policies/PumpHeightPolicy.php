<?php

namespace Modules\Pumps\Policies;

use Modules\Users\Entities\User;
use Modules\Pumps\Entities\HeightPumps;
use Illuminate\Auth\Access\HandlesAuthorization;

class PumpHeightPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the height pumps.
     *
     * @return mixed
     */
    public function view()
    {
        return User::find(auth()->user()->id)->Group->permission->show_pump_height == 'true';
    }

    /**
     * Determine whether the user can create height pumps.
     *
     * @return mixed
     */
    public function create()
    {
        return User::find(auth()->user()->id)->Group->permission->create_pump_height == 'true';
    }

    /**
     * Determine whether the user can update the height pumps.
     *
     * @return mixed
     */
    public function update()
    {
        return User::find(auth()->user()->id)->Group->permission->edit_pump_height == 'true';
    }

    /**
     * Determine whether the user can delete the height pumps.
     *
     * @return mixed
     */
    public function delete()
    {
        return User::find(auth()->user()->id)->Group->permission->delete_pump_height == 'true';
    }

    /**
     * Determine whether the user can restore the height pumps.
     *
     * @param  \App\User  $user
     * @param  \App\HeightPumps  $heightPumps
     * @return mixed
     */
    public function restore(User $user, HeightPumps $heightPumps)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the height pumps.
     *
     * @param  \App\User  $user
     * @param  \App\HeightPumps  $heightPumps
     * @return mixed
     */
    public function forceDelete(User $user, HeightPumps $heightPumps)
    {
        //
    }
}
