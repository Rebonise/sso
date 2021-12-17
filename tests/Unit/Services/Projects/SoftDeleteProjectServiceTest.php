<?php

namespace Tests\Unit\Services\Projects;

use App\Models\Project;
use App\Services\Projects\SoftDeleteProjectService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SoftDeleteProjectServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_soft_delete_project_service_can_soft_delete_project()
    {
        $project = Project::factory()->create();
        $response = SoftDeleteProjectService::delete($project);

        $this->assertTrue($response);
    }
}
