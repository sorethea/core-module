<?php

namespace Modules\Core\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Core\Models\User;

class PermissionPolicy
{
    use HandlesAuthorization;

    public function before(User $user): bool{
        return $user->can("permissions.manager");
    }

    public function viewAny(User $user): bool{
        return $user->can("permissions.viewAny");
    }

    public function view(User $user): bool{
        return $user->can("permissions.view");
    }

    public function create(User $user):bool{
        return $user->can('permissions.create');
    }

    public function update(User $user):bool{
        return $user->can('permissions.update');
    }
    public function delete(User $user):bool{
        return $user->can('permissions.delete');
    }
    public function restore(User $user):bool{
        return $user->can('permissions.restore');
    }
    public function forceDelete(User $user):bool{
        return $user->can('permissions.forceDelete');
    }
}
