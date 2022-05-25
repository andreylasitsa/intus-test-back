<?php

namespace App\Actions;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class LinkCheckerAction
{
    /**
     * Check url for bad way
     *
     * @param string $original_link
     * @return bool
     */
    public function __invoke(string $original_link): bool
    {

        $google_safe_browsing_api_key = ('AIzaSyBUiU2HdYdxSNNDvZ8P9ux7LDWIKwS0qxk');
        $google_safe_browsing_api_url = ('https://safebrowsing.googleapis.com/v4/threatMatches:find');

        $params =
            [
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
        $client = new Client();

        $status = 0;
        try {
            $res = $client->request('POST', $google_safe_browsing_api_url, [
                'json' => $params,
                'query' => [
                    'key' => $google_safe_browsing_api_key
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
