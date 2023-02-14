<?php

namespace Modules\Core\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Modules\Core\Models\User;
use Modules\Core\Policies\PermissionPolicy;
use Modules\Core\Policies\RolePolicy;
use Modules\Core\Policies\UserPolicy;
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
