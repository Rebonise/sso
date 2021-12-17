<?php

namespace App\Services\Projects;

use App\Models\Project;

class SoftDeleteProjectService {
    /**
     * Delete the project.
     *
     * @param Project $project The project instance.
     * @return bool|null
     */
    public static function delete(Project $project) {
        return $project->delete();
    }
}