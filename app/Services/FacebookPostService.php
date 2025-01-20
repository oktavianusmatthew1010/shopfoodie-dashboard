<?php

namespace App\Services;

use GuzzleHttp\Client;
use Exception;

class FacebookPostService
{
    protected $client;
    protected $graphApiUrl = 'https://graph.facebook.com/v17.0';
    protected $pageAccessToken;
    protected $pageId;

    public function __construct()
    {
        $this->client = new Client();
        $this->pageAccessToken = env('FACEBOOK_PAGE_ACCESS_TOKEN');
        $this->pageId = env('FACEBOOK_PAGE_ID');
    }

    public function postToFacebook($message)
    {
        try {
            $url = "{$this->graphApiUrl}/{$this->pageId}/feed";

            $response = $this->client->post($url, [
                'query' => [
                    'access_token' => $this->pageAccessToken,
                ],
                'form_params' => [
                    'message' => $message,
                ],
            ]);

            $responseBody = json_decode($response->getBody(), true);

            return [
                'success' => true,
                'post_id' => $responseBody['id'] ?? null,
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }
}
