<?php

namespace App\Livewire;

use App\Models\Application;
use Illuminate\View\View;
use Livewire\Component;

class ExhibitorsList extends Component
{
    public string $search = '';

    public function render(): View
    {
        $grouped = Application::query()
            ->where('status', 'approved')
            ->whereNotNull('gallery_name')
            ->where('gallery_name', '!=', '')
            ->when($this->search !== '', fn ($q) => $q->where('gallery_name', 'like', '%' . $this->search . '%'))
            ->orderBy('gallery_name')
            ->get()
            ->groupBy(fn (Application $application) => mb_strtoupper(mb_substr($application->gallery_name, 0, 1)))
            ->sortKeys();

        return view('livewire.exhibitors-list', compact('grouped'));
    }
}
