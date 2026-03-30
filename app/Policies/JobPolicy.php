<?php
namespace App\Policies;

use App\Models\Job;
use App\Models\User;

class JobPolicy
{
    public function update(User $user, Job $job): bool {
        return $user->id === $job->user_id || $user->isAdmin();
    }
    public function delete(User $user, Job $job): bool {
        return $user->id === $job->user_id || $user->isAdmin();
    }
    public function view(User $user, Job $job): bool {
        return $user->id === $job->user_id || $user->isAdmin();
    }
}
