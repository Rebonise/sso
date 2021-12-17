<?php

namespace Tests\Unit\Services\Clients;

use App\Models\Client;
use App\Models\Project;
use App\Services\Clients\StoreClientService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreClientServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_client_service_can_store_project()
    {
        $project = Project::factory()->create();
        $client_payload = [
            'project_id' => $project->id,
            'name' => 'Shiroyuki',
        ];

        StoreClientService::store(new Client, $client_payload);

        $this->assertGreaterThan(0, $project->clients->count());
    }
}
