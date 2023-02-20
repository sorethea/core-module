<?php

namespace Modules\Core\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Coresys\Models\User;

class RolePolicy
{
    use HandlesAuthorization;

    public function before(User $user): bool{
        return $user->can("roles.manager");
    }

    public function viewAny(User $user): bool{
        return $user->can("roles.viewAny");
    }

    public function view(User $user): bool{
        return $user->can("roles.view");
    }

    public function create(User $user):bool{
        return $user->can('roles.create');
    }

    public function update(User $user):bool{
        return $user->can('roles.update');
    }
    public function delete(User $user):bool{
        return $user->can('roles.delete');
    }
    public function restore(User $user):bool{
        return $user->can('roles.restore');
    }
    public function forceDelete(User $user):bool{
        return $user->can('roles.forceDelete');
    }
}
