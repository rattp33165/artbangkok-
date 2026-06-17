<?php

namespace App\Livewire;

use App\Models\Application;
use Illuminate\View\View;
use Livewire\Component;

class AdminApplicationReview extends Component
{
    public Application $application;
    public string $adminNotes = '';
    public ?string $pendingAction = null;

    public function mount(int $applicationId): void
    {
        $this->application = Application::with('user', 'reviewer')->findOrFail($applicationId);
        $this->adminNotes = $this->application->admin_notes ?? '';
    }

    public function saveNotes(): void
    {
        $this->application->update(['admin_notes' => $this->adminNotes]);
        $this->dispatch('toast', message: 'Notes saved.', type: 'success');
    }

    public function setAction(string $action): void
    {
        if (!in_array($action, ['approve', 'reject', 'review'])) {
            return;
        }
        $this->pendingAction = $action;
    }

    public function cancelAction(): void
    {
        $this->pendingAction = null;
    }

    public function executeAction(): void
    {
        $statusMap = [
            'approve' => 'approved',
            'reject'  => 'rejected',
            'review'  => 'under_review',
        ];

        if (!array_key_exists($this->pendingAction, $statusMap)) {
            return;
        }

        $action = $this->pendingAction;

        $this->application->update([
            'status'      => $statusMap[$action],
            'reviewed_by' => auth()->id(),
            'reviewed_at' => now(),
            'admin_notes' => $this->adminNotes,
        ]);

        $this->application->refresh();
        $this->pendingAction = null;

        $messages = [
            'approve' => 'Application approved.',
            'reject'  => 'Application rejected.',
            'review'  => 'Marked as under review.',
        ];

        $this->dispatch('toast', message: $messages[$action], type: 'success');
    }

    public function approveEditRequest(): void
    {
        if ($this->application->status !== 'approved' || !$this->application->edit_requested) {
            return;
        }

        $this->application->update([
            'status'        => 'draft',
            'edit_requested' => false,
            'reviewed_by'   => auth()->id(),
            'reviewed_at'   => now(),
        ]);

        $this->application->refresh();
        $this->dispatch('toast', message: 'Edit request approved. Application unlocked for editing.', type: 'success');
    }

    public function render(): View
    {
        return view('livewire.admin-application-review');
    }
}
