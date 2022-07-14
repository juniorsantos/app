<?php

namespace Domains\Transaction\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class AuthorizationTransactionService
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://run.mocky.io',
        ]);
    }

    /**
     * @return string[]
     */
    public function authorize(): array
    {
        $endPoint = '/v3/8fafdd68-a090-496f-8c9a-3442cf30dae6';
        try {
            $response = $this->client->request('GET', $endPoint);
            return json_decode($response->getBody(), true);
        } catch (GuzzleException $exception) {
            return ['message' => 'not authorized'];
        }
    }
}
