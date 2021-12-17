<?php

namespace App\Services\Clients;

use App\Models\Client;

class StoreClientService {
    /**
     * Store the client data.
     *
     * @param Client $client The client instance.
     * @param array $client_payload The client data payload.
     * @return void
     */
    public static function store(Client $client, array $client_payload)
    {
        return $client->insert($client_payload);
    }
}