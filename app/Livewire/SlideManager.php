<?php

namespace App\Livewire;

use App\Models\Slide;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SlideManager extends Component
{
    use WithFileUploads;

    // Modal state
    public bool $showModal   = false;
    public bool $showAddForm = false;

    // Edit state
    public ?int $editingId = null;
    public string $editTitle          = '';
    public string $editSubtitle       = '';
    public string $editObjectPosition = 'center';

    // Add form
    public string $title           = '';
    public string $subtitle        = '';
    public string $object_position = 'center';
    public $image;

    private function authorizeAdmin(): void
    {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            abort(403);
        }
    }

    public function openModal(): void
    {
        $this->authorizeAdmin();
        $this->showModal   = true;
        $this->showAddForm = false;
        $this->resetAdd();
    }

    public function closeModal(): void
    {
        $this->showModal   = false;
        $this->showAddForm = false;
        $this->editingId   = null;
        $this->resetAdd();
        $this->dispatch('slides-updated');
    }

    // ── Add ────────────────────────────────────────────────────────

    public function save()
    {
        $this->validate([
            'image'           => 'required|image|mimes:jpeg,png,webp|max:5120',
            'title'           => 'nullable|string|max:255',
            'subtitle'        => 'nullable|string|max:255',
            'object_position' => 'required|in:top,center,bottom',
        ]);

        $path     = $this->image->store('slides', 'public');
        $maxOrder = Slide::max('sort_order') ?? 0;

        Slide::create([
            'title'           => $this->title ?: null,
            'subtitle'        => $this->subtitle ?: null,
            'image_path'      => $path,
            'object_position' => $this->object_position,
            'sort_order'      => $maxOrder + 1,
            'is_active'       => true,
        ]);

        $this->resetAdd();
        $this->showAddForm = false;
        $this->dispatch('toast', message: 'Slide added.', type: 'success');
    }

    private function resetAdd(): void
    {
        $this->title           = '';
        $this->subtitle        = '';
        $this->object_position = 'center';
        $this->image           = null;
    }

    // ── Edit ───────────────────────────────────────────────────────

    public function startEdit($id): void
    {
        $slide                    = Slide::findOrFail($id);
        $this->editingId          = $id;
        $this->editTitle          = $slide->title ?? '';
        $this->editSubtitle       = $slide->subtitle ?? '';
        $this->editObjectPosition = $slide->object_position ?? 'center';
    }

    public function saveEdit(): void
    {
        $this->validate([
            'editTitle'          => 'nullable|string|max:255',
            'editSubtitle'       => 'nullable|string|max:255',
            'editObjectPosition' => 'required|in:top,center,bottom',
        ]);

        Slide::findOrFail($this->editingId)->update([
            'title'           => $this->editTitle ?: null,
            'subtitle'        => $this->editSubtitle ?: null,
            'object_position' => $this->editObjectPosition,
        ]);

        $this->editingId = null;
        $this->dispatch('toast', message: 'Slide updated.', type: 'success');
    }

    public function cancelEdit(): void
    {
        $this->editingId = null;
    }

    // ── Delete ─────────────────────────────────────────────────────

    public function delete($id): void
    {
        $slide = Slide::findOrFail($id);
        if ($slide->image_path) {
            Storage::disk('public')->delete($slide->image_path);
        }
        $slide->delete();
        $this->reorder();
        $this->dispatch('toast', message: 'Slide deleted.', type: 'success');
    }

    // ── Toggle ─────────────────────────────────────────────────────

    public function toggleActive($id): void
    {
        $slide = Slide::findOrFail($id);
        $slide->update(['is_active' => !$slide->is_active]);
        $this->dispatch('toast', message: $slide->is_active ? 'Slide hidden.' : 'Slide visible.', type: 'info');
    }

    // ── Reorder ────────────────────────────────────────────────────

    public function moveUp($id): void
    {
        $slides = Slide::orderBy('sort_order')->get();
        $index  = $slides->search(fn($s) => $s->id === $id);
        if ($index > 0) {
            [$slides[$index]->sort_order, $slides[$index - 1]->sort_order] =
                [$slides[$index - 1]->sort_order, $slides[$index]->sort_order];
            $slides[$index]->save();
            $slides[$index - 1]->save();
            $this->dispatch('toast', message: 'Order updated.', type: 'success');
        }
    }

    public function moveDown($id): void
    {
        $slides = Slide::orderBy('sort_order')->get();
        $index  = $slides->search(fn($s) => $s->id === $id);
        if ($index < $slides->count() - 1) {
            [$slides[$index]->sort_order, $slides[$index + 1]->sort_order] =
                [$slides[$index + 1]->sort_order, $slides[$index]->sort_order];
            $slides[$index]->save();
            $slides[$index + 1]->save();
            $this->dispatch('toast', message: 'Order updated.', type: 'success');
        }
    }

    private function reorder(): void
    {
        Slide::orderBy('sort_order')->get()->each(fn($s, $i) => $s->update(['sort_order' => $i + 1]));
    }

    public function render()
    {
        return view('livewire.slide-manager', [
            'slides' => Slide::orderBy('sort_order')->get(),
        ]);
    }
}
