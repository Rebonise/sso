<?php

namespace App\Services\Clients;

use App\Models\Client;

class SoftDeleteClientService {
    /**
     * Delete the client.
     *
     * @param Client $client The client instance.
     * @return bool|null
     */
    public static function delete(Client $client) {
        return $client->delete();
    }
}