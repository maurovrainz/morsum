<?php

namespace App\Service;

use GuzzleHttp\Client;

class LastfmService
{
    const URL = 'http://ws.audioscrobbler.com/2.0/';
    
    /**
     *
     * @var string
     */
    protected $apiId;
    
    /**
     *
     * @var Client
     */
    protected $client;
    
    public function __construct(array $config)
    {
        $this->apiId = $config['api_id'];
        $this->client = new Client();
    }
    
    public function getTopTenArtists()
    {
        $response = $this->client->get(self::URL, [
            'query' => [
                'method' => 'chart.gettopartists',
                'api_key' => $this->apiId, 
                'format' => 'json',
                'limit' => '10',
                'page' => '1'
            ]
        ]);
        
        return json_decode((string)$response->getBody(), true);
    }
}
