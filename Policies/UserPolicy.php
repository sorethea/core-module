<?php

namespace Modules\Core\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function before(User $user): bool{
        return $user->can("users.manager");
    }

    public function viewAny(User $user): bool{
        return $user->can("users.viewAny");
    }

    public function view(User $user, User $model): bool{
        return $user->can("users.view");
    }
}
