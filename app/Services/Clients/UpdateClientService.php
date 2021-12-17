<?php

namespace App\Services\Clients;

use App\Models\Client;

class UpdateClientService {
    /**
     * Store the client data.
     *
     * @param Client $client The client instance.
     * @param array $client_payload The client data payload.
     * @return bool
     */
    public static function update(Client $client, array $client_payload)
    {
        return $client->update($client_payload);
    }
}