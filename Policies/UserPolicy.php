<?php

namespace Modules\Core\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function after(User $user): bool{
        return $user->can("users.manager");
    }

    public function viewAny(User $user): bool{
        return $user->can("users.viewAny");
    }
}
