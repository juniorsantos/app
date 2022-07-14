<?php

namespace Domains\Transaction\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class NotificationService
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'http://o4d9z.mocklab.io',
        ]);
    }

    /**
     * @param $userId
     *
     * @return array|string
     */
    public function notifyUser(string $userId): array|string
    {
        $endPoint = '/notify/'.$userId;
        try {
            $response = $this->client->request('GET', $endPoint);
            return json_decode($response->getBody(), true);
        } catch (GuzzleException $exception) {
            return ['not send'];
        }
    }
}
