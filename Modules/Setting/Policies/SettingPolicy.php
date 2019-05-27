<?php

namespace Modules\Setting\Policies;

use Modules\Users\Entities\User;
use Modules\Setting\Entities\Setting;
use Illuminate\Auth\Access\HandlesAuthorization;

class SettingPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the setting.
     *
     * @return mixed
     */
    public function view()
    {
        return User::find(auth()->user()->id)->Group->permission->show_settings == 'true';
    }

    /**
     * Determine whether the user can create settings.
     *
     * @return mixed
     */
    public function create()
    {
        return User::find(auth()->user()->id)->Group->permission->create_settings == 'true';
    }

    /**
     * Determine whether the user can update the setting.
     *
     * @return mixed
     */
    public function update()
    {
        return User::find(auth()->user()->id)->Group->permission->edit_settings == 'true';
    }

    /**
     * Determine whether the user can delete the setting.
     *
     * @return mixed
     */
    public function delete()
    {
        return User::find(auth()->user()->id)->Group->permission->delete_settings == 'true';
    }

    /**
     * Determine whether the user can restore the setting.
     *
     * @param  \App\User  $user
     * @param  \App\Setting  $setting
     * @return mixed
     */
    public function restore(User $user, Setting $setting)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the setting.
     *
     * @param  \App\User  $user
     * @param  \App\Setting  $setting
     * @return mixed
     */
    public function forceDelete(User $user, Setting $setting)
    {
        //
    }
}
