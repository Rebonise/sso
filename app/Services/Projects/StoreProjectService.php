<?php

namespace App\Services\Projects;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;

class StoreProjectService {
    /**
     * Store the project data.
     *
     * @param User|Authenticatable $user The user instance.
     * @param array $project_payload The project data payload.
     * @return void
     */
    public static function store(User $user, array $project_payload)
    {
        $user->projects()->create($project_payload);
    }
}