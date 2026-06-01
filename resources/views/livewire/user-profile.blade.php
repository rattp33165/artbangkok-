<div class="space-y-6">

    {{-- Profile Photo --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="font-semibold text-black">Profile Photo</h2>
            <p class="text-xs text-gray-400 mt-0.5">Update your profile picture</p>
        </div>
        <div class="p-6 flex items-center gap-6">
            <div class="w-20 h-20 rounded-full bg-gray-100 flex-shrink-0 overflow-hidden">
                @if(Auth::user()->profile_photo)
                    <img src="{{ Auth::user()->profile_photo }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center text-2xl font-bold text-gray-400">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                @endif
            </div>
            <div>
                @if(Auth::user()->google_id)
                    <p class="text-sm text-gray-500 mb-1">Synced from Google account</p>
                    <p class="text-xs text-gray-400">Your photo is managed by Google</p>
                @else
                    <div x-data>
                        <input type="file" wire:model="photo_upload" x-ref="photoFile"
                               class="hidden" accept="image/jpeg,image/png,image/webp">
                        <button type="button" @click="$refs.photoFile.click()"
                                wire:loading.attr="disabled"
                                wire:target="photo_upload"
                                class="inline-flex items-center gap-2 bg-black text-white px-4 py-2 rounded-xl text-sm font-semibold hover:bg-gray-800 transition">
                            <svg wire:loading wire:target="photo_upload" class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 22 6.477 22 12h-4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span wire:loading.remove wire:target="photo_upload">Upload Photo</span>
                            <span wire:loading wire:target="photo_upload">Uploading...</span>
                        </button>
                        <p class="text-xs text-gray-400 mt-2">JPG, PNG or WebP · max 2MB</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Display Name --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="font-semibold text-black">Display Name</h2>
        </div>
        <div class="p-6 space-y-4">
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Name</label>
                <input wire:model="name" type="text" maxlength="255"
                       class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-black @error('name') border-red-400 bg-red-50 @enderror">
                @error('name') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="flex justify-end">
                <button wire:click="saveName"
                        wire:loading.attr="disabled"
                        wire:target="saveName"
                        class="bg-black text-white px-6 py-2.5 rounded-xl text-sm font-semibold hover:bg-gray-800 transition inline-flex items-center gap-2">
                    <svg wire:loading wire:target="saveName" class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 22 6.477 22 12h-4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span wire:loading.remove wire:target="saveName">Save</span>
                    <span wire:loading wire:target="saveName">Saving...</span>
                </button>
            </div>
        </div>
    </div>

    {{-- Login Email --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="font-semibold text-black">Login Email</h2>
        </div>
        <div class="p-6">
            <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl">
                @if(Auth::user()->google_id)
                    <svg width="18" height="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0">
                        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                        <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                    </svg>
                @else
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="text-gray-400 flex-shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                @endif
                <span class="text-sm text-gray-700">{{ Auth::user()->email }}</span>
                @if(Auth::user()->google_id)
                    <span class="ml-auto text-xs text-gray-400 bg-white border border-gray-200 px-2 py-0.5 rounded-full">Google</span>
                @endif
            </div>
            @if(Auth::user()->google_id)
                <p class="text-xs text-gray-400 mt-2">Email is managed by your Google account</p>
            @endif
        </div>
    </div>

    {{-- Change Password (non-Google users only) --}}
    @if(!Auth::user()->google_id)
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="font-semibold text-black">Change Password</h2>
        </div>
        <div class="p-6 space-y-4">
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Current Password</label>
                <input wire:model="current_password" type="password"
                       class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-black @error('current_password') border-red-400 bg-red-50 @enderror">
                @error('current_password') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">New Password</label>
                <input wire:model="new_password" type="password"
                       class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-black @error('new_password') border-red-400 bg-red-50 @enderror">
                @error('new_password') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Confirm New Password</label>
                <input wire:model="new_password_confirmation" type="password"
                       class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-black">
            </div>
            <div class="flex justify-end">
                <button wire:click="changePassword"
                        wire:loading.attr="disabled"
                        wire:target="changePassword"
                        class="bg-black text-white px-6 py-2.5 rounded-xl text-sm font-semibold hover:bg-gray-800 transition inline-flex items-center gap-2">
                    <svg wire:loading wire:target="changePassword" class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 22 6.477 22 12h-4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span wire:loading.remove wire:target="changePassword">Change Password</span>
                    <span wire:loading wire:target="changePassword">Saving...</span>
                </button>
            </div>
        </div>
    </div>
    @endif

</div>
