<?php

namespace Modules\Core\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Modules\Core\Policies\UserPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies =[
        User::class=>UserPolicy::class,
    ];
    public function register()
    {
        $this->registerPolicies();
        parent::register();
    }
}
