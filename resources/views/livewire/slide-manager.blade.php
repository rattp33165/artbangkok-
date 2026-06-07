<div x-data="{
    confirmOpen: false,
    confirmId: null,
    openConfirm(id) { this.confirmId = id; this.confirmOpen = true; },
    closeConfirm() { this.confirmOpen = false; this.confirmId = null; }
}">
    {{-- Custom Confirm Dialog --}}
    <div x-show="confirmOpen"
         x-transition:enter="transition ease-out duration-150"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-100"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-[150] flex items-center justify-center px-4"
         style="display:none;">
        <div class="absolute inset-0 bg-black/40" @click="closeConfirm()"></div>
        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-sm p-6 z-10"
             x-transition:enter="transition ease-out duration-150"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-full bg-red-50 flex items-center justify-center flex-shrink-0">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="text-red-500">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                </div>
                <div>
                    <p class="font-semibold text-black text-sm">Delete Slide</p>
                    <p class="text-xs text-gray-500 mt-0.5">This action cannot be undone.</p>
                </div>
            </div>
            <div class="flex gap-2 justify-end">
                <button @click="closeConfirm()"
                        class="px-4 py-2 text-xs text-gray-600 hover:text-black rounded-xl hover:bg-gray-100 transition font-medium">
                    Cancel
                </button>
                <button @click="$wire.delete(confirmId); closeConfirm()"
                        class="px-4 py-2 text-xs text-white bg-red-500 hover:bg-red-600 rounded-xl transition font-semibold">
                    Delete
                </button>
            </div>
        </div>
    </div>

    {{-- Manage Button (auth only) --}}
    @auth
    <button wire:click="openModal"
            class="inline-flex items-center gap-2 bg-white/90 hover:bg-white text-black text-xs font-semibold px-4 py-2 rounded-full shadow transition">
        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
        Manage Slides
    </button>
    @endauth

    {{-- Modal --}}
    @if($showModal)
    <div class="fixed inset-0 z-[100] flex items-center justify-center px-4"
         x-data
         x-on:keydown.escape.window="$wire.closeModal()">

        {{-- Backdrop --}}
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" wire:click="closeModal"></div>

        {{-- Modal Box --}}
        <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[85vh] flex flex-col z-10">

            {{-- Header --}}
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 flex-shrink-0">
                <h2 class="font-bold text-black text-lg">Manage Slides</h2>
                <button wire:click="closeModal" class="text-gray-400 hover:text-black transition">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            {{-- Scrollable Body --}}
            <div class="overflow-y-auto flex-1 px-6 py-4 space-y-3">

                {{-- Slide List --}}
                @forelse($slides as $i => $slide)
                <div class="border border-gray-100 rounded-xl overflow-hidden">

                    {{-- View mode --}}
                    @if($editingId !== $slide->id)
                    <div class="flex items-center gap-3 p-3 transition-opacity duration-200"
                         wire:loading.class="opacity-40 pointer-events-none"
                         wire:target="moveUp({{ $slide->id }}),moveDown({{ $slide->id }}),toggleActive({{ $slide->id }}),delete({{ $slide->id }}),startEdit({{ $slide->id }})">

                        {{-- Thumbnail --}}
                        <div class="w-20 h-14 rounded-lg overflow-hidden bg-gray-100 flex-shrink-0">
                            @if($slide->image_path)
                                <img src="{{ Storage::url($slide->image_path) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-300">
                                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        {{-- Info --}}
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-black truncate">{{ $slide->title ?: '(No title)' }}</p>
                            <p class="text-xs text-gray-400 truncate">{{ $slide->subtitle ?: '(No subtitle)' }}</p>
                        </div>

                        {{-- Actions --}}
                        <div class="flex items-center gap-1.5 flex-shrink-0">
                            <button wire:click="moveUp({{ $slide->id }})"
                                    @class(['p-1.5 rounded-lg transition text-gray-400 hover:text-black hover:bg-gray-100', 'opacity-30 pointer-events-none' => $i === 0])>
                                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
                            </button>
                            <button wire:click="moveDown({{ $slide->id }})"
                                    @class(['p-1.5 rounded-lg transition text-gray-400 hover:text-black hover:bg-gray-100', 'opacity-30 pointer-events-none' => $i === $slides->count() - 1])>
                                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                            <button wire:click="toggleActive({{ $slide->id }})"
                                    title="{{ $slide->is_active ? 'Hide' : 'Show' }}"
                                    class="p-1.5 rounded-lg transition {{ $slide->is_active ? 'text-emerald-500 bg-emerald-50 hover:bg-emerald-100' : 'text-gray-300 hover:text-gray-500 hover:bg-gray-100' }}">
                                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </button>
                            <button wire:click="startEdit({{ $slide->id }})"
                                    class="p-1.5 rounded-lg text-gray-400 hover:text-black hover:bg-gray-100 transition">
                                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                            </button>
                            <button @click="openConfirm({{ $slide->id }})"
                                    class="p-1.5 rounded-lg text-gray-400 hover:text-red-500 hover:bg-red-50 transition">
                                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </div>
                    </div>

                    {{-- Edit mode --}}
                    @else
                    <div class="p-4 bg-gray-50 space-y-3">
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Title</label>
                            <input wire:model="editTitle" type="text"
                                   class="w-full border border-gray-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-black">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Subtitle</label>
                            <input wire:model="editSubtitle" type="text"
                                   class="w-full border border-gray-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-black">
                        </div>
                        <div class="flex gap-2">
                            <button wire:click="saveEdit"
                                    wire:loading.attr="disabled"
                                    wire:loading.class="opacity-60 cursor-wait"
                                    wire:target="saveEdit"
                                    class="bg-black text-white text-xs font-semibold px-4 py-2 rounded-xl hover:bg-gray-800 transition inline-flex items-center gap-1.5">
                                <svg wire:loading wire:target="saveEdit" class="animate-spin h-3 w-3" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 22 6.477 22 12h-4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <span wire:loading.remove wire:target="saveEdit">Save</span>
                                <span wire:loading wire:target="saveEdit">Saving...</span>
                            </button>
                            <button wire:click="cancelEdit" class="text-xs text-gray-500 hover:text-black px-4 py-2 rounded-xl hover:bg-gray-100 transition">Cancel</button>
                        </div>
                    </div>
                    @endif

                </div>
                @empty
                <p class="text-center text-gray-400 text-sm py-6">No slides yet. Add one below.</p>
                @endforelse

                {{-- Add Form (inside scrollable body) --}}
                @if($showAddForm)
                <div class="border-2 border-dashed border-gray-200 rounded-xl p-5 space-y-4"
                     x-data="{
                         preview: null,
                         pos: '{{ $object_position }}'
                     }">
                    <p class="text-sm font-bold text-black">Add New Slide</p>

                    {{-- Image Preview + Upload --}}
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                            Image <span class="text-red-500">*</span>
                            <span class="normal-case font-normal text-gray-400">(JPG, PNG, WebP · max 5MB)</span>
                        </label>
                        <div x-show="preview" class="mb-2 rounded-xl overflow-hidden border border-gray-200 h-48">
                            <img :src="preview" class="w-full h-full object-cover">
                        </div>
                        <div x-show="!preview" class="mb-2 rounded-xl border-2 border-dashed border-gray-200 bg-gray-50 h-48 flex flex-col items-center justify-center gap-2 text-gray-300">
                            <svg width="36" height="36" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span class="text-xs">Image preview</span>
                        </div>
                        <input type="file" wire:model="image" accept="image/jpeg,image/png,image/webp"
                               @change="preview = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : null"
                               class="w-full text-sm text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-black file:text-white file:text-xs file:font-semibold hover:file:bg-gray-800 file:transition cursor-pointer">
                        @error('image') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                        <div wire:loading wire:target="image" class="text-xs text-gray-400 mt-1">Uploading...</div>
                    </div>

                    {{-- Title --}}
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Title</label>
                        <input wire:model="title" type="text" placeholder="e.g. Art Bangkok 2026"
                               class="w-full border border-gray-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-black">
                    </div>

                    {{-- Subtitle --}}
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Subtitle</label>
                        <input wire:model="subtitle" type="text" placeholder="e.g. Bangkok · Thailand · 2026"
                               class="w-full border border-gray-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-black">
                    </div>


                    {{-- Actions --}}
                    <div class="flex gap-2">
                        <button wire:click="save"
                                wire:loading.attr="disabled"
                                wire:loading.class="opacity-70 cursor-not-allowed"
                                wire:target="save"
                                class="bg-black text-white text-xs font-semibold px-5 py-2.5 rounded-xl hover:bg-gray-800 transition inline-flex items-center gap-2">
                            <svg wire:loading wire:target="save" class="animate-spin h-3 w-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 22 6.477 22 12h-4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span wire:loading.remove wire:target="save">Add Slide</span>
                            <span wire:loading wire:target="save">Saving...</span>
                        </button>
                        <button wire:click="$set('showAddForm', false)"
                                class="text-xs text-gray-500 hover:text-black px-4 py-2.5 rounded-xl hover:bg-gray-100 transition">
                            Cancel
                        </button>
                    </div>
                </div>
                @endif

            </div>

            {{-- Footer: Add button --}}
            @if(!$showAddForm)
            <div class="border-t border-gray-100 px-6 py-4 flex-shrink-0">
                <button wire:click="$set('showAddForm', true)"
                        class="flex items-center gap-2 text-sm font-semibold text-black hover:text-gray-500 transition">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add New Slide
                </button>
            </div>
            @endif

        </div>
    </div>
    @endif
</div>
