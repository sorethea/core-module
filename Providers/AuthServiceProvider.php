<?php

namespace Modules\Core\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Modules\Core\Filament\Resources\PermissionResource;
use Modules\Core\Filament\Resources\RoleResource;
use Modules\Core\Policies\PermissionPolicy;
use Modules\Core\Policies\UserPolicy;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies =[
        User::class=>UserPolicy::class,
        Role::class=>RoleResource::class,
        Permission::class=>PermissionPolicy::class,
    ];
    public function register()
    {
        $this->registerPolicies();
        parent::register();
    }
}
