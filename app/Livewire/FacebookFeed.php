<?php

namespace App\Livewire;

use App\Models\FacebookPost;
use Livewire\Attributes\On;
use Livewire\Component;

class FacebookFeed extends Component
{
    public int $limit = 4;

    #[On('feed-updated')]
    public function refresh(): void {}

    public function render()
    {
        return view('livewire.facebook-feed', [
            'posts' => FacebookPost::visible()
                ->orderByRaw('CASE WHEN sort_order > 0 THEN sort_order ELSE 9999 END')
                ->orderByDesc('posted_at')
                ->limit($this->limit)
                ->get(),
        ]);
    }
}
