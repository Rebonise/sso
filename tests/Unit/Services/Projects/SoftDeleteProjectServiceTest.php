<?php

namespace Tests\Unit\Services\Projects;

use App\Models\Project;
use App\Models\User;
use App\Services\Projects\SoftDeleteProjectService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
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
        $response = SoftDeleteProjectService::delete(Project::factory()->create());

        $this->assertTrue($response);
    }
}
