<div class="space-y-6">

    {{-- Status Filter Tabs --}}
    <div class="flex flex-wrap gap-2">
        @php
        $tabs = [
            ''               => ['label' => 'All',            'count' => $counts['all']],
            'submitted'      => ['label' => 'Submitted',      'count' => $counts['submitted']],
            'under_review'   => ['label' => 'Under Review',   'count' => $counts['under_review']],
            'approved'       => ['label' => 'Approved',       'count' => $counts['approved']],
            'rejected'       => ['label' => 'Rejected',       'count' => $counts['rejected']],
            'edit_requested' => ['label' => 'Edit Requested', 'count' => $counts['edit_requested']],
        ];
        @endphp
        @foreach($tabs as $value => $tab)
        <button wire:click="$set('statusFilter', '{{ $value }}')"
                class="inline-flex items-center gap-1.5 px-4 py-2 text-xs rounded-full border transition
                       {{ $statusFilter === $value
                            ? 'bg-black text-white border-black'
                            : 'bg-white text-gray-600 border-gray-200 hover:border-gray-400' }}">
            {{ $tab['label'] }}
            @if($tab['count'] > 0)
            <span class="font-normal {{ $statusFilter === $value ? 'text-gray-300' : 'text-gray-400' }}">
                {{ $tab['count'] }}
            </span>
            @endif
        </button>
        @endforeach
    </div>

    {{-- Search --}}
    <div class="relative">
        <input wire:model.live.debounce.300ms="search"
               type="text"
               placeholder="Search by gallery name or applicant..."
               class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-black transition bg-white">
        <svg class="absolute left-3 top-3 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
    </div>

    {{-- Table --}}
    <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden">
        <div class="overflow-x-auto">
        <table class="w-full min-w-[720px]">
            <thead>
                <tr class="border-b border-gray-100">
                    <th class="px-6 py-4 text-left text-xs uppercase tracking-widest text-gray-400 font-normal">Gallery</th>
                    <th class="px-6 py-4 text-left text-xs uppercase tracking-widest text-gray-400 font-normal">Applicant</th>
                    <th class="px-6 py-4 text-left text-xs uppercase tracking-widest text-gray-400 font-normal">Status</th>
                    <th class="px-6 py-4 text-left text-xs uppercase tracking-widest text-gray-400 font-normal">Progress</th>
                    <th class="px-6 py-4 text-left text-xs uppercase tracking-widest text-gray-400 font-normal">Updated</th>
                    <th class="px-6 py-4 text-right text-xs uppercase tracking-widest text-gray-400 font-normal">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($applications as $app)
                <tr class="hover:bg-gray-50/50 transition" wire:key="app-{{ $app->id }}">

                    {{-- Gallery --}}
                    <td class="px-6 py-4">
                        <p class="text-sm font-medium text-black">{{ $app->gallery_name ?: '(Unnamed)' }}</p>
                        @if($app->gallery_type)
                        <p class="text-xs text-gray-400 mt-0.5">{{ ucfirst(str_replace('_', ' ', $app->gallery_type)) }}</p>
                        @endif
                    </td>

                    {{-- Applicant --}}
                    <td class="px-6 py-4">
                        @if($app->user)
                        <p class="text-sm text-gray-700">{{ $app->user->name }}</p>
                        <p class="text-xs text-gray-400">{{ $app->user->email }}</p>
                        @else
                        <span class="text-xs text-gray-400">—</span>
                        @endif
                    </td>

                    {{-- Status --}}
                    <td class="px-6 py-4">
                        @php
                        $badge = match($app->status) {
                            'submitted'    => 'bg-blue-50 text-blue-700',
                            'under_review' => 'bg-yellow-50 text-yellow-700',
                            'approved'     => 'bg-green-50 text-green-700',
                            'rejected'     => 'bg-red-50 text-red-700',
                            default        => 'bg-gray-100 text-gray-500',
                        };
                        @endphp
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $badge }}">
                            {{ ucwords(str_replace('_', ' ', $app->status)) }}
                        </span>
                        @if($app->edit_requested)
                        <span class="inline-flex items-center gap-1 mt-1 px-2 py-0.5 rounded-full text-xs font-medium bg-orange-50 text-orange-600 border border-orange-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-orange-400 inline-block"></span>
                            Edit Requested
                        </span>
                        @endif
                    </td>

                    {{-- Progress --}}
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            <div class="w-20 h-1.5 bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full bg-black rounded-full transition-all"
                                     style="width: {{ $app->completion_percent ?? 0 }}%"></div>
                            </div>
                            <span class="text-xs text-gray-500">{{ $app->completion_percent ?? 0 }}%</span>
                        </div>
                    </td>

                    {{-- Updated --}}
                    <td class="px-6 py-4">
                        <span class="text-xs text-gray-500">{{ $app->updated_at->format('d M Y') }}</span>
                    </td>

                    {{-- Actions --}}
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('admin.applications.show', $app->id) }}"
                           class="inline-flex items-center gap-1.5 text-xs text-gray-500 hover:text-black border border-gray-200 hover:border-gray-400 rounded-lg px-3 py-1.5 transition">
                            Review
                            <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-16 text-center text-sm text-gray-400">
                        No applications found
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        </div>

        <div class="px-6 py-4 border-t border-gray-100 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">

            <p class="text-xs text-gray-400">
                Showing {{ number_format($applications->firstItem() ?? 0) }}–{{ number_format($applications->lastItem() ?? 0) }}
                of {{ number_format($applications->total()) }} applications
            </p>

            <div class="flex items-center gap-2 self-end sm:self-auto">

                {{-- Per-page --}}
                <select wire:model.live="perPage"
                        class="border border-gray-200 rounded-lg px-3 py-1.5 text-xs text-gray-600 focus:outline-none focus:border-black transition bg-white">
                    <option value="10">10 / page</option>
                    <option value="25">25 / page</option>
                    <option value="50">50 / page</option>
                </select>

                @if($applications->hasPages())
                <div class="flex items-center gap-1 ml-1">

                    {{-- Prev --}}
                    <button wire:click="previousPage" @disabled($applications->onFirstPage())
                            class="p-2 rounded-lg transition
                                   {{ $applications->onFirstPage() ? 'text-gray-200 cursor-not-allowed' : 'text-gray-400 hover:text-black hover:bg-gray-50' }}">
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </button>

                    {{-- Page numbers --}}
                    @php
                        $cur  = $applications->currentPage();
                        $last = $applications->lastPage();
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
                    <button wire:click="nextPage" @disabled(!$applications->hasMorePages())
                            class="p-2 rounded-lg transition
                                   {{ !$applications->hasMorePages() ? 'text-gray-200 cursor-not-allowed' : 'text-gray-400 hover:text-black hover:bg-gray-50' }}">
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>

                </div>
                @endif

            </div>
        </div>
    </div>

</div>
