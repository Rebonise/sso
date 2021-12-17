<?php

namespace Tests\Unit\Services\Clients;

use App\Models\Client;
use App\Services\Clients\UpdateClientService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateClientServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_update_client_service_can_update_client()
    {
        $client = Client::factory()->create();
        $client_payload = [
            'name' => 'Shiroyuki',
        ];

        $response = UpdateClientService::update($client, $client_payload);

        $this->assertTrue($response);
    }
}
