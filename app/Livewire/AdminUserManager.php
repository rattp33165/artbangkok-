<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class AdminUserManager extends Component
{
    use WithPagination;

    public string $search = '';
    public string $roleFilter = '';
    public int $perPage = 10;
    public ?int $confirmDeleteId = null;
    public string $confirmDeleteName = '';

    public function updatedSearch(): void { $this->resetPage(); }
    public function updatedRoleFilter(): void { $this->resetPage(); }
    public function updatedPerPage(): void { $this->resetPage(); }

    public function changeRole(int $userId, string $role): void
    {
        if ($userId === auth()->id()) {
            $this->dispatch('toast', message: 'Cannot change your own role.', type: 'error');
            return;
        }

        if (!in_array($role, ['gallery', 'admin'])) {
            return;
        }

        User::findOrFail($userId)->update(['role' => $role]);
        $this->dispatch('toast', message: 'Role updated successfully.', type: 'success');
    }

    public function confirmDelete(int $userId, string $name): void
    {
        $this->confirmDeleteId = $userId;
        $this->confirmDeleteName = $name;
    }

    public function cancelDelete(): void
    {
        $this->confirmDeleteId = null;
        $this->confirmDeleteName = '';
    }

    public function deleteUser(): void
    {
        if (!$this->confirmDeleteId) {
            return;
        }

        if ($this->confirmDeleteId === auth()->id()) {
            $this->dispatch('toast', message: 'Cannot delete your own account.', type: 'error');
            $this->cancelDelete();
            return;
        }

        User::findOrFail($this->confirmDeleteId)->delete();
        $this->cancelDelete();
        $this->dispatch('toast', message: 'User deleted successfully.', type: 'success');
    }

    public function render(): View
    {
        $users = User::query()
            ->when($this->search, function ($q) {
                $q->where(function ($inner) {
                    $inner->where('name', 'like', "%{$this->search}%")
                          ->orWhere('email', 'like', "%{$this->search}%");
                });
            })
            ->when($this->roleFilter, fn($q) => $q->where('role', $this->roleFilter))
            ->with('application:id,user_id,status,completion_percent')
            ->latest()
            ->paginate($this->perPage);

        $stats = [
            'total'   => User::count(),
            'admins'  => User::where('role', 'admin')->count(),
            'gallery' => User::where('role', 'gallery')->count(),
        ];

        return view('livewire.admin-user-manager', compact('users', 'stats'));
    }
}
