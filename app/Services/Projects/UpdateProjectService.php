<?php

namespace App\Services\Projects;

use App\Models\Project;

class UpdateProjectService {
    /**
     * Store the project data.
     *
     * @param Project $project The project instance.
     * @param array $project_payload The project data payload.
     * @return bool
     */
    public static function update(Project $project, array $project_payload)
    {
        return $project->update($project_payload);
    }
}