<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FacebookService
{
    private string $pageId;
    private string $pageToken;
    private string $apiVersion = 'v19.0';

    public function __construct()
    {
        $this->pageId    = config('services.facebook.page_id', '');
        $this->pageToken = config('services.facebook.page_token', '');
    }

    public function isConfigured(): bool
    {
        return !empty($this->pageId) && !empty($this->pageToken);
    }

    public function fetchPosts(int $limit = 10): array
    {
        $response = Http::get("https://graph.facebook.com/{$this->apiVersion}/{$this->pageId}/posts", [
            'fields'       => 'id,message,full_picture,permalink_url,created_time',
            'limit'        => $limit,
            'access_token' => $this->pageToken,
        ]);

        if ($response->failed()) {
            throw new \RuntimeException('Facebook API error: ' . $response->body());
        }

        return $response->json('data', []);
    }
}
