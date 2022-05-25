<?php

namespace App\Actions;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class LinkCheckerAction
{

    /**
     * @var Client
     */
    private $client;
    /**
     * @var mixed
     */
    private $google_safe_browsing_api_url;
    /**
     * @var mixed
     */
    private $google_safe_browsing_api_key;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->google_safe_browsing_api_key = env('GOOGLE_API_CHECKER_KEY', 'AIzaSyBUiU2HdYdxSNNDvZ8P9ux7LDWIKwS0qxk');
        $this->google_safe_browsing_api_url = env('GOOGLE_API_CHECKER_URL', 'https://safebrowsing.googleapis.com/v4/threatMatches:find');
    }

    /**
     * Check url for bad way
     *
     * @param string $original_link
     * @return bool
     */
    public function __invoke(string $original_link): bool
    {
        $params = [
            'client' => [
                'clientId' => 'shortcut-1337',
                'clientVersion' => '1.5.2'
            ],
            'threatInfo' => [
                'threatTypes' => ['MALWARE', 'SOCIAL_ENGINEERING'],
                'platformTypes' => ['WINDOWS', 'OSX', 'LINUX'],
                'threatEntryTypes' => ['URL'],
                'threatEntries' => [
                    ['url' => $original_link]
                ]
            ]
        ];

        $status = 0;
        try {
            $res = $this->client->request('POST', $this->google_safe_browsing_api_url, [
                'json' => $params,
                'query' => [
                    'key' => $this->google_safe_browsing_api_key
                ]
            ]);
            $status = $res->getStatusCode();

        } catch (GuzzleException $exception) {
            return false;
        }
        if ($status != 200) {
            return false;
        }
        return true;
    }
}
