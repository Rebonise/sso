<?php

namespace App\Services\Projects;

use App\Models\Project;

class StoreProjectService {
    /**
     * Store the project data.
     *
     * @param Project $project The project instance.
     * @param array $project_payload The project data payload.
     * @return void
     */
    public static function store(Project $project, array $project_payload)
    {
        return $project->insert($project_payload);
    }
}