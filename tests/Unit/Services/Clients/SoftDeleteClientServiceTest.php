<?php

namespace Tests\Unit\Services\Clients;

use App\Models\Client;
use App\Services\Clients\SoftDeleteClientService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SoftDeleteClientServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_soft_delete_client_service_can_soft_delete_client()
    {
        $client = Client::factory()->create();
        $response = SoftDeleteClientService::delete($client);

        $this->assertTrue($response);
    }
}
