<?php

namespace App\Livewire;

use App\Models\Application;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class AdminApplicationList extends Component
{
    use WithPagination;

    public string $search = '';
    public string $statusFilter = '';
    public int $perPage = 10;

    public function updatedSearch(): void { $this->resetPage(); }
    public function updatedStatusFilter(): void { $this->resetPage(); }
    public function updatedPerPage(): void { $this->resetPage(); }

    public function render(): View
    {
        $applications = Application::query()
            ->with('user:id,name,email,profile_photo')
            ->when($this->search, function ($q) {
                $q->where(function ($inner) {
                    $inner->where('gallery_name', 'like', "%{$this->search}%")
                          ->orWhereHas('user', fn($u) => $u->where('name', 'like', "%{$this->search}%")
                              ->orWhere('email', 'like', "%{$this->search}%"));
                });
            })
            ->when($this->statusFilter === 'edit_requested', fn($q) => $q->where('edit_requested', true))
            ->when($this->statusFilter && $this->statusFilter !== 'edit_requested', fn($q) => $q->where('status', $this->statusFilter))
            ->latest()
            ->paginate($this->perPage);

        $counts = [
            'all'            => Application::count(),
            'submitted'      => Application::where('status', 'submitted')->count(),
            'under_review'   => Application::where('status', 'under_review')->count(),
            'approved'       => Application::where('status', 'approved')->count(),
            'rejected'       => Application::where('status', 'rejected')->count(),
            'edit_requested' => Application::where('edit_requested', true)->count(),
        ];

        return view('livewire.admin-application-list', compact('applications', 'counts'));
    }
}
