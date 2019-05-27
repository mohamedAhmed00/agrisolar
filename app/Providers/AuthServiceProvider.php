<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Modules\Groups\Entities\Group;
use Modules\Groups\Policies\GroupPolicy;
use Modules\Pumps\Entities\HeightPumps;
use Modules\Pumps\Entities\Pump;
use Modules\Pumps\Policies\PumpHeightPolicy;
use Modules\Pumps\Policies\PumpPolicy;
use Modules\Setting\Entities\Setting;
use Modules\Setting\Policies\SettingPolicy;
use Modules\Users\Entities\User;
use Modules\Users\Policies\UserPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        Pump::class         => PumpPolicy::class,
        HeightPumps::class  => PumpHeightPolicy::class,
        Group::class        => GroupPolicy::class,
        User::class         => UserPolicy::class,
        Setting::class      => SettingPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
