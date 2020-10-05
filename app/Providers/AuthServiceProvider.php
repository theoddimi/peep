<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('edit-peep', function ($user, $peep) {
          return $user->id === $peep->user_id;
        });
        Gate::define('edit-avatar', function ($user) {
          return $user->id === \Auth::id();
        });

        Passport::routes();

        Passport::tokensExpireIn(\Carbon\Carbon::now()->addDays(15));

        Passport::refreshTokensExpireIn(\Carbon\Carbon::now()->addDays(30));

        Passport::personalAccessTokensExpireIn(\Carbon\Carbon::now()->addMonths(6));
    }
}
