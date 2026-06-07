<?php

namespace App\Livewire;

use App\Models\FacebookPost;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FacebookFeedManager extends Component
{
    public bool $showModal = false;

    private function authorizeAdmin(): void
    {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            abort(403);
        }
    }

    public function openModal(): void
    {
        $this->authorizeAdmin();
        $this->showModal = true;
    }

    public function closeModal(): void
    {
        $this->showModal = false;
        // Dispatch feed-updated only on close so parent doesn't re-render while modal is open
        $this->dispatch('feed-updated');
    }

    public function toggleVisible($id): void
    {
        $this->authorizeAdmin();
        $post = FacebookPost::findOrFail($id);
        $post->update(['is_visible' => !$post->is_visible]);
        $this->dispatch('toast',
            message: $post->is_visible ? 'Post visible.' : 'Post hidden.',
            type: 'info'
        );
    }

    public function moveUp($id): void
    {
        $this->authorizeAdmin();
        $this->ensureSortOrder();
        $posts = FacebookPost::orderBy('sort_order')->get();
        $index = $posts->search(fn($p) => $p->id === $id);
        if ($index > 0) {
            [$posts[$index]->sort_order, $posts[$index - 1]->sort_order] =
                [$posts[$index - 1]->sort_order, $posts[$index]->sort_order];
            $posts[$index]->save();
            $posts[$index - 1]->save();
            $this->dispatch('toast', message: 'Order updated.', type: 'success');
        }
    }

    public function moveDown($id): void
    {
        $this->authorizeAdmin();
        $this->ensureSortOrder();
        $posts = FacebookPost::orderBy('sort_order')->get();
        $index = $posts->search(fn($p) => $p->id === $id);
        if ($index < $posts->count() - 1) {
            [$posts[$index]->sort_order, $posts[$index + 1]->sort_order] =
                [$posts[$index + 1]->sort_order, $posts[$index]->sort_order];
            $posts[$index]->save();
            $posts[$index + 1]->save();
            $this->dispatch('toast', message: 'Order updated.', type: 'success');
        }
    }

    private function ensureSortOrder(): void
    {
        if (FacebookPost::where('sort_order', 0)->exists()) {
            FacebookPost::orderByDesc('posted_at')
                ->get()
                ->each(fn($p, $i) => $p->update(['sort_order' => $i + 1]));
        }
    }

    public function render()
    {
        return view('livewire.facebook-feed-manager', [
            'posts' => FacebookPost::orderByRaw('CASE WHEN sort_order > 0 THEN sort_order ELSE 9999 END')
                ->orderByDesc('posted_at')
                ->get(),
        ]);
    }
}
