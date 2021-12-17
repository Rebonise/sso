<?php

namespace Tests\Unit\Services\Projects;

use App\Models\User;
use App\Services\Projects\StoreProjectService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class StoreProjectServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_project_service_can_store_project()
    {
        $user = User::factory()->create();
        $project_payload = [
            'name' => 'Shiroyuki',
            'key' => Str::random(),
        ];

        StoreProjectService::store($user, $project_payload);

        $this->assertGreaterThan(0, $user->projects->count());
    }
}
