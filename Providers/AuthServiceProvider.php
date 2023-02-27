<?php

namespace Modules\Core\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Modules\LAM\Models\User;
use Modules\LAM\Policies\PermissionPolicy;
use Modules\LAM\Policies\RolePolicy;
use Modules\LAM\Policies\UserPolicy;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies =[
        User::class=>UserPolicy::class,
        Role::class=>RolePolicy::class,
        Permission::class=>PermissionPolicy::class,
    ];
    public function register()
    {
        $this->registerPolicies();
        parent::register();
    }
}
