<?php

namespace Tests\Unit\Services\Projects;

use App\Models\User;
use App\Services\Projects\UpdateProjectService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class UpdateProjectServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_project_service_can_update_project()
    {
        $user = User::factory()->hasProjects(1)->create();
        $project_payload = [
            'name' => 'Shiroyuki',
            'key' => Str::random(),
        ];

        $response = UpdateProjectService::update($user->projects->first(), $project_payload);

        $this->assertTrue($response);
    }
}
