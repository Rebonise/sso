<?php

namespace Tests\Unit\Services\Projects;

use App\Models\Project;
use App\Services\Projects\UpdateProjectService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateProjectServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_update_project_service_can_update_project()
    {
        $project = Project::factory()->create();

        $response = UpdateProjectService::update(Project::find($project->id), [
            'name' => 'Menghatsu',
        ]);

        $this->assertTrue($response);
    }
}
