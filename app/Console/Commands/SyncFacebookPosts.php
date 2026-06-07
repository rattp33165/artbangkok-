<?php

namespace App\Console\Commands;

use App\Models\FacebookPost;
use App\Services\FacebookService;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class SyncFacebookPosts extends Command
{
    protected $signature   = 'facebook:sync {--limit=10 : Number of posts to fetch}';
    protected $description = 'Sync latest posts from Facebook Page to database';

    public function handle(FacebookService $fb): int
    {
        if (!$fb->isConfigured()) {
            $this->error('Facebook credentials not configured. Set FACEBOOK_PAGE_ID and FACEBOOK_PAGE_TOKEN in .env');
            return self::FAILURE;
        }

        $this->info('Fetching posts from Facebook...');

        try {
            $posts = $fb->fetchPosts((int) $this->option('limit'));
        } catch (\RuntimeException $e) {
            $this->error($e->getMessage());
            return self::FAILURE;
        }

        if (empty($posts)) {
            $this->warn('No posts returned from Facebook.');
            return self::SUCCESS;
        }

        $now  = Carbon::now();
        $newCount = 0;

        foreach ($posts as $post) {
            $existing = FacebookPost::where('fb_post_id', $post['id'])->first();

            $data = [
                'message'      => $post['message'] ?? null,
                'full_picture' => $post['full_picture'] ?? null,
                'permalink_url'=> $post['permalink_url'],
                'posted_at'    => Carbon::parse($post['created_time']),
                'synced_at'    => $now,
            ];

            if ($existing) {
                $existing->update($data);
            } else {
                FacebookPost::create(array_merge($data, [
                    'fb_post_id' => $post['id'],
                    'is_visible' => true,
                    'sort_order' => 0,
                ]));
                $newCount++;
            }
        }

        $this->info("Sync complete. {$newCount} new post(s) added, " . (count($posts) - $newCount) . " updated.");
        return self::SUCCESS;
    }
}
