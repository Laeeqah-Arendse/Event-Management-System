<?php

namespace App\Policies;

use App\Models\LAEvent;
use App\Models\User;

class LAEventPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, LAEvent $event): bool
    {
        return true;
    }

    public function create(User $user)
{
    return true;
}

public function update(User $user, LAEvent $event): bool
{
    return in_array($user->role, ['admin', 'organizer']);
}

public function delete(User $user, LAEvent $event): bool
{
    return in_array($user->role, ['admin', 'organizer']);
}

}
