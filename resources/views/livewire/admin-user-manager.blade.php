<div class="space-y-6">

    {{-- Stats --}}
    <div class="grid grid-cols-3 gap-4">
        <div class="bg-white border border-gray-100 rounded-2xl p-6">
            <p class="text-xs uppercase tracking-widest text-gray-400 mb-1">Total Users</p>
            <p class="text-3xl font-semibold text-black">{{ $stats['total'] }}</p>
        </div>
        <div class="bg-white border border-gray-100 rounded-2xl p-6">
            <p class="text-xs uppercase tracking-widest text-gray-400 mb-1">No Application</p>
            <p class="text-3xl font-semibold text-black">{{ $stats['no_application'] }}</p>
        </div>
        <div class="bg-white border border-gray-100 rounded-2xl p-6">
            <p class="text-xs uppercase tracking-widest text-gray-400 mb-1">Admins</p>
            <p class="text-3xl font-semibold text-black">{{ $stats['admins'] }}</p>
        </div>
    </div>

    {{-- Search & Filter --}}
    <div class="flex flex-wrap gap-3">
        <div class="flex-1 relative">
            <input wire:model.live.debounce.300ms="search"
                   type="text"
                   placeholder="Search by name or email..."
                   class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-black transition bg-white">
            <svg class="absolute left-3 top-3 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
        </div>
        <select wire:model.live="roleFilter"
                class="border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:border-black transition bg-white">
            <option value="">All Roles</option>
            <option value="gallery">Gallery</option>
            <option value="admin">Admin</option>
        </select>
        <select wire:model.live="noApplicationFilter"
                class="border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:border-black transition bg-white">
            <option value="">All</option>
            <option value="1">No Application</option>
        </select>
    </div>

    {{-- Table --}}
    <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden">
        <div class="overflow-x-auto">
        <table class="w-full min-w-[640px]">
            <thead>
                <tr class="border-b border-gray-100">
                    <th class="px-6 py-4 text-left text-xs uppercase tracking-widest text-gray-400 font-normal">User</th>
                    <th class="px-6 py-4 text-left text-xs uppercase tracking-widest text-gray-400 font-normal">Role</th>
                    <th class="px-6 py-4 text-left text-xs uppercase tracking-widest text-gray-400 font-normal">Application</th>
                    <th class="px-6 py-4 text-left text-xs uppercase tracking-widest text-gray-400 font-normal">Joined</th>
                    <th class="px-6 py-4 text-right text-xs uppercase tracking-widest text-gray-400 font-normal">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($users as $user)
                <tr class="hover:bg-gray-50/50 transition" wire:key="user-{{ $user->id }}">

                    {{-- User --}}
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full bg-black flex items-center justify-center overflow-hidden flex-shrink-0">
                                @if($user->profile_photo)
                                    <img src="{{ $user->profile_photo }}" class="w-full h-full object-cover" alt="">
                                @else
                                    <span class="text-white text-sm font-semibold">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </span>
                                @endif
                            </div>
                            <div>
                                <p class="text-sm font-medium text-black">
                                    {{ $user->name }}
                                    @if($user->id === auth()->id())
                                        <span class="text-xs text-gray-400 ml-1">(you)</span>
                                    @endif
                                </p>
                                <p class="text-xs text-gray-400">{{ $user->email }}</p>
                            </div>
                        </div>
                    </td>

                    {{-- Role --}}
                    <td class="px-6 py-4">
                        @if($user->id === auth()->id())
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-black text-white">
                                Admin
                            </span>
                        @else
                            <select wire:change="changeRole({{ $user->id }}, $event.target.value)"
                                    class="text-xs border rounded-full px-3 py-1.5 focus:outline-none transition cursor-pointer appearance-none pr-6
                                           {{ $user->role === 'admin' ? 'border-black bg-black text-white' : 'border-gray-200 bg-white text-gray-700 hover:border-gray-400' }}">
                                <option value="gallery" @selected($user->role === 'gallery') class="bg-white text-gray-700">Gallery</option>
                                <option value="admin" @selected($user->role === 'admin') class="bg-white text-gray-700">Admin</option>
                            </select>
                        @endif
                    </td>

                    {{-- Application --}}
                    <td class="px-6 py-4">
                        @if($user->application)
                            @php
                                $badge = match($user->application->status) {
                                    'submitted'    => 'bg-blue-50 text-blue-700',
                                    'under_review' => 'bg-yellow-50 text-yellow-700',
                                    'approved'     => 'bg-green-50 text-green-700',
                                    'rejected'     => 'bg-red-50 text-red-700',
                                    default        => 'bg-gray-100 text-gray-600',
                                };
                            @endphp
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.applications.show', $user->application->id) }}"
                                   class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $badge }} hover:opacity-80 transition">
                                    {{ ucwords(str_replace('_', ' ', $user->application->status)) }}
                                </a>
                                @if($user->application->completion_percent > 0)
                                    <span class="text-xs text-gray-400">{{ $user->application->completion_percent }}%</span>
                                @endif
                            </div>
                        @else
                            <span class="text-xs text-gray-400">—</span>
                        @endif
                    </td>

                    {{-- Joined --}}
                    <td class="px-6 py-4">
                        <span class="text-xs text-gray-500">{{ $user->created_at->format('d M Y') }}</span>
                    </td>

                    {{-- Actions --}}
                    <td class="px-6 py-4 text-right">
                        @if($user->id !== auth()->id())
                            <button wire:click="confirmDelete({{ $user->id }}, '{{ addslashes($user->name) }}')"
                                    class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition"
                                    title="Delete user">
                                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        @else
                            <span class="w-9 h-9 inline-block"></span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-16 text-center text-sm text-gray-400">
                        No users found
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        </div>

        <div class="px-6 py-4 border-t border-gray-100 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">

            <p class="text-xs text-gray-400">
                Showing {{ number_format($users->firstItem() ?? 0) }}–{{ number_format($users->lastItem() ?? 0) }}
                of {{ number_format($users->total()) }} users
            </p>

            <div class="flex items-center gap-2 self-end sm:self-auto">

                {{-- Per-page --}}
                <select wire:model.live="perPage"
                        class="border border-gray-200 rounded-lg px-3 py-1.5 text-xs text-gray-600 focus:outline-none focus:border-black transition bg-white">
                    <option value="10">10 / page</option>
                    <option value="25">25 / page</option>
                    <option value="50">50 / page</option>
                </select>

                @if($users->hasPages())
                <div class="flex items-center gap-1 ml-1">

                    {{-- Prev --}}
                    <button wire:click="previousPage" @disabled($users->onFirstPage())
                            class="p-2 rounded-lg transition
                                   {{ $users->onFirstPage() ? 'text-gray-200 cursor-not-allowed' : 'text-gray-400 hover:text-black hover:bg-gray-50' }}">
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </button>

                    {{-- Page numbers --}}
                    @php
                        $cur  = $users->currentPage();
                        $last = $users->lastPage();
                        $pages = collect([1])
                            ->merge(range(max(1, $cur - 2), min($last, $cur + 2)))
                            ->push($last)
                            ->unique()->sort()->values();
                    @endphp
                    @php $prev = null; @endphp
                    @foreach($pages as $p)
                        @if($prev && $p - $prev > 1)
                            <span class="w-7 text-center text-xs text-gray-300">···</span>
                        @endif
                        <button wire:click="gotoPage({{ $p }})"
                                class="w-8 h-8 text-xs rounded-lg transition
                                       {{ $p === $cur
                                           ? 'bg-black text-white font-medium'
                                           : 'text-gray-500 hover:bg-gray-50 hover:text-black' }}">
                            {{ $p }}
                        </button>
                        @php $prev = $p; @endphp
                    @endforeach

                    {{-- Next --}}
                    <button wire:click="nextPage" @disabled(!$users->hasMorePages())
                            class="p-2 rounded-lg transition
                                   {{ !$users->hasMorePages() ? 'text-gray-200 cursor-not-allowed' : 'text-gray-400 hover:text-black hover:bg-gray-50' }}">
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>

                </div>
                @endif

            </div>
        </div>
    </div>

    {{-- Delete Confirmation Modal --}}
    @if($confirmDeleteId)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm">
        <div class="bg-white rounded-2xl shadow-xl p-8 max-w-sm w-full mx-4">
            <div class="w-12 h-12 bg-red-50 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="text-red-500">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <h3 class="text-center text-lg font-semibold text-black mb-1">Delete User</h3>
            <p class="text-center text-sm text-gray-500 mb-6">
                Are you sure you want to delete <strong class="text-black">{{ $confirmDeleteName }}</strong>?<br>
                This action cannot be undone.
            </p>
            <div class="flex gap-3">
                <button wire:click="cancelDelete"
                        class="flex-1 py-2.5 border border-gray-200 text-gray-700 text-sm rounded-xl hover:border-gray-400 transition">
                    Cancel
                </button>
                <button wire:click="deleteUser"
                        wire:loading.attr="disabled"
                        class="flex-1 py-2.5 bg-red-500 text-white text-sm rounded-xl hover:bg-red-600 transition disabled:opacity-60">
                    <span wire:loading.remove wire:target="deleteUser">Delete</span>
                    <span wire:loading wire:target="deleteUser">Deleting…</span>
                </button>
            </div>
        </div>
    </div>
    @endif

</div>
