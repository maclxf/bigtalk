<?php
require_once __DIR__ . '/vendor/autoload.php';

use GuzzleHttp\Client;

class Track17 {
    private $base;
    private $appsecret;

    public function __construct()
    {
        // 测试
        $this->base = 'https://api.17track.net/track/v1/';
        $this->appsecret = '2EFAD4C5858292B56F1068AC23D9B7B1';

        /******************************************************************/

        /**************************************************************** */
    }

    public function request()
    {
        $client = new Client(['base_uri' => $this->base]);
        $response = $client->request(
            "POST",
            //'gettrackinfo',
            'register',
            [
                'headers' => [
                    'Content-Type' => 'application/json',
                    '17token' => $this->appsecret,
                ],
                'json' => [
                    [
                    'number' => 'BH155400725SE',
                    'carrier' => '3013'
                    ]
                ],
                'config' => [
                    'curl' => [
                        CURLOPT_SSL_VERIFYPEER => false,
                        CURLOPT_SSL_VERIFYHOST => false
                    ]
                ],
                //'debug' => true,
                'http_errors' => false,
            ]
        );

        try {

            $body = $response->getBody();


            // Implicitly cast the body to a string and echo it
            $data = json_decode($body);
            var_dump($data);
            return $data;
        } catch (GuzzleHttp\Exception\BadResponseException $th) {
            return [
                'code' => 402,
                'message' => $th->getMessage(),
                'data' => []
            ];
        }
    }
}

$track = new Track17();

$track->request();