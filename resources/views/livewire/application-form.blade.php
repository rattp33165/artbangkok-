<div class="space-y-6">

    {{-- 1. Gallery Information --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="font-semibold text-black">Gallery Information</h2>
            <p class="text-xs text-gray-400 mt-0.5">Basic information about your gallery</p>
        </div>
        <div class="p-6 space-y-4">

            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                    Gallery Type <span class="text-red-500">*</span>
                </label>
                <select wire:model="gallery_type"
                        class="w-full border rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 @error('gallery_type') border-red-400 bg-red-50 focus:ring-red-200 @else border-gray-200 focus:ring-black @enderror">
                    <option value="">Select gallery type</option>
                    <option value="international">International Gallery</option>
                    <option value="thai">Thai Gallery</option>
                </select>
                @error('gallery_type')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                        Gallery Name (ENG) <span class="text-red-500">*</span>
                    </label>
                    <input wire:model="gallery_name" type="text" placeholder="Gallery name"
                           class="w-full border rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 @error('gallery_name') border-red-400 bg-red-50 focus:ring-red-200 @else border-gray-200 focus:ring-black @enderror">
                    @error('gallery_name')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                        Year Founded <span class="text-red-500">*</span>
                    </label>
                    <select wire:model="year_founded"
                            class="w-full border rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 @error('year_founded') border-red-400 bg-red-50 focus:ring-red-200 @else border-gray-200 focus:ring-black @enderror">
                        <option value="">Select year</option>
                        @for($y = date('Y'); $y >= 1900; $y--)
                            <option value="{{ $y }}">{{ $y }}</option>
                        @endfor
                    </select>
                    @error('year_founded')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                    Gallery Brief Description <span class="text-red-500">*</span>
                    <span class="text-gray-400 normal-case font-normal">(max 1,000 characters)</span>
                </label>
                <textarea wire:model="description" rows="4" placeholder="Describe your gallery..."
                          maxlength="1000"
                          class="w-full border rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 resize-none @error('description') border-red-400 bg-red-50 focus:ring-red-200 @else border-gray-200 focus:ring-black @enderror"></textarea>
                @error('description')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                        Website URL <span class="text-red-500">*</span>
                    </label>
                    <input wire:model="website_url" type="url" placeholder="https://yourgallery.com"
                           class="w-full border rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 @error('website_url') border-red-400 bg-red-50 focus:ring-red-200 @else border-gray-200 focus:ring-black @enderror">
                    @error('website_url')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                        Gallery Email <span class="text-red-500">*</span>
                    </label>
                    <input wire:model="gallery_email" type="email" placeholder="gallery@example.com"
                           class="w-full border rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 @error('gallery_email') border-red-400 bg-red-50 focus:ring-red-200 @else border-gray-200 focus:ring-black @enderror">
                    @error('gallery_email')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                        Phone Number <span class="text-red-500">*</span>
                    </label>
                    <input wire:model="phone" type="text" placeholder="+66 2 000 0000"
                           class="w-full border rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 @error('phone') border-red-400 bg-red-50 focus:ring-red-200 @else border-gray-200 focus:ring-black @enderror">
                    @error('phone')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                        Instagram <span class="text-red-500">*</span>
                    </label>
                    <input wire:model="instagram" type="text" placeholder="@yourgallery"
                           class="w-full border rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 @error('instagram') border-red-400 bg-red-50 focus:ring-red-200 @else border-gray-200 focus:ring-black @enderror">
                    @error('instagram')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                        Facebook <span class="text-red-500">*</span>
                    </label>
                    <input wire:model="facebook" type="text" placeholder="facebook.com/yourgallery"
                           class="w-full border rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 @error('facebook') border-red-400 bg-red-50 focus:ring-red-200 @else border-gray-200 focus:ring-black @enderror">
                    @error('facebook')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end pt-2">
                <button wire:click="saveGalleryInfo"
                        wire:loading.attr="disabled"
                        wire:loading.class="opacity-70 cursor-not-allowed"
                        wire:target="saveGalleryInfo"
                        class="bg-black text-white px-6 py-2.5 rounded-xl text-sm font-semibold hover:bg-gray-800 transition inline-flex items-center gap-2">
                    <svg wire:loading wire:target="saveGalleryInfo" class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 22 6.477 22 12h-4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span wire:loading.remove wire:target="saveGalleryInfo">Save Draft</span>
                    <span wire:loading wire:target="saveGalleryInfo">Saving...</span>
                </button>
            </div>
        </div>
    </div>

    {{-- 2. Business Registration --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="font-semibold text-black">Business Registration Information</h2>
            <p class="text-xs text-gray-400 mt-0.5">Official business details</p>
        </div>
        <div class="p-6 space-y-4">
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                    Business or Company Name <span class="text-red-500">*</span>
                </label>
                <input wire:model="business_name" type="text" placeholder="Company name"
                       class="w-full border rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 @error('business_name') border-red-400 bg-red-50 focus:ring-red-200 @else border-gray-200 focus:ring-black @enderror">
                @error('business_name')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                    Business License Number <span class="text-red-500">*</span>
                </label>
                <input wire:model="business_license" type="text" placeholder="License number"
                       class="w-full border rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 @error('business_license') border-red-400 bg-red-50 focus:ring-red-200 @else border-gray-200 focus:ring-black @enderror">
                @error('business_license')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex justify-end pt-2">
                <button wire:click="saveBusinessInfo"
                        wire:loading.attr="disabled"
                        wire:loading.class="opacity-70 cursor-not-allowed"
                        wire:target="saveBusinessInfo"
                        class="bg-black text-white px-6 py-2.5 rounded-xl text-sm font-semibold hover:bg-gray-800 transition inline-flex items-center gap-2">
                    <svg wire:loading wire:target="saveBusinessInfo" class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 22 6.477 22 12h-4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span wire:loading.remove wire:target="saveBusinessInfo">Save Draft</span>
                    <span wire:loading wire:target="saveBusinessInfo">Saving...</span>
                </button>
            </div>
        </div>
    </div>

    {{-- 3. Gallery Head Office --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="font-semibold text-black">Gallery Head Office Information</h2>
            <p class="text-xs text-gray-400 mt-0.5">Main office location and director details</p>
        </div>
        <div class="p-6 space-y-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                        Country <span class="text-red-500">*</span>
                    </label>
                    <input wire:model="office_country" type="text" placeholder="Country"
                           class="w-full border rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 @error('office_country') border-red-400 bg-red-50 focus:ring-red-200 @else border-gray-200 focus:ring-black @enderror">
                    @error('office_country')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                        City <span class="text-red-500">*</span>
                    </label>
                    <input wire:model="office_city" type="text" placeholder="City"
                           class="w-full border rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 @error('office_city') border-red-400 bg-red-50 focus:ring-red-200 @else border-gray-200 focus:ring-black @enderror">
                    @error('office_city')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                        Zipcode <span class="text-red-500">*</span>
                    </label>
                    <input wire:model="office_zipcode" type="text" placeholder="00000"
                           class="w-full border rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 @error('office_zipcode') border-red-400 bg-red-50 focus:ring-red-200 @else border-gray-200 focus:ring-black @enderror">
                    @error('office_zipcode')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                    Detailed Address <span class="text-red-500">*</span>
                </label>
                <textarea wire:model="office_address" rows="2" placeholder="Full address"
                          class="w-full border rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 resize-none @error('office_address') border-red-400 bg-red-50 focus:ring-red-200 @else border-gray-200 focus:ring-black @enderror"></textarea>
                @error('office_address')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                        Director's Name <span class="text-red-500">*</span>
                    </label>
                    <input wire:model="director_name" type="text" placeholder="Full name"
                           class="w-full border rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 @error('director_name') border-red-400 bg-red-50 focus:ring-red-200 @else border-gray-200 focus:ring-black @enderror">
                    @error('director_name')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                        Phone Number <span class="text-red-500">*</span>
                    </label>
                    <input wire:model="director_phone" type="text" placeholder="+66 2 000 0000"
                           class="w-full border rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 @error('director_phone') border-red-400 bg-red-50 focus:ring-red-200 @else border-gray-200 focus:ring-black @enderror">
                    @error('director_phone')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                        Email Address <span class="text-red-500">*</span>
                    </label>
                    <input wire:model="director_email" type="email" placeholder="director@gallery.com"
                           class="w-full border rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 @error('director_email') border-red-400 bg-red-50 focus:ring-red-200 @else border-gray-200 focus:ring-black @enderror">
                    @error('director_email')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="flex justify-end pt-2">
                <button wire:click="saveHeadOffice"
                        wire:loading.attr="disabled"
                        wire:loading.class="opacity-70 cursor-not-allowed"
                        wire:target="saveHeadOffice"
                        class="bg-black text-white px-6 py-2.5 rounded-xl text-sm font-semibold hover:bg-gray-800 transition inline-flex items-center gap-2">
                    <svg wire:loading wire:target="saveHeadOffice" class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 22 6.477 22 12h-4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span wire:loading.remove wire:target="saveHeadOffice">Save Draft</span>
                    <span wire:loading wire:target="saveHeadOffice">Saving...</span>
                </button>
            </div>
        </div>
    </div>

    {{-- 4. Gallery Branches --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="font-semibold text-black">Gallery Branch Information</h2>
            <p class="text-xs text-gray-400 mt-0.5">Up to 3 branch locations</p>
        </div>
        <div class="p-6 space-y-6">
            @foreach($branches as $i => $branch)
            <div class="pb-6 {{ $i < 2 ? 'border-b border-gray-100' : '' }}">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">
                    Branch {{ $i + 1 }} @if($i === 0)<span class="text-red-500 normal-case font-normal ml-1">* required</span>@endif
                </p>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                            Venue/Branch Name @if($i === 0)<span class="text-red-500">*</span>@endif
                        </label>
                        <input wire:model="branches.{{ $i }}.name" type="text" placeholder="Branch name"
                               class="w-full border rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 @error("branches.{$i}.name") border-red-400 bg-red-50 focus:ring-red-200 @else border-gray-200 focus:ring-black @enderror">
                        @error("branches.{$i}.name")
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                            Country @if($i === 0)<span class="text-red-500">*</span>@endif
                        </label>
                        <input wire:model="branches.{{ $i }}.country" type="text" placeholder="Country"
                               class="w-full border rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 @error("branches.{$i}.country") border-red-400 bg-red-50 focus:ring-red-200 @else border-gray-200 focus:ring-black @enderror">
                        @error("branches.{$i}.country")
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                            City @if($i === 0)<span class="text-red-500">*</span>@endif
                        </label>
                        <input wire:model="branches.{{ $i }}.city" type="text" placeholder="City"
                               class="w-full border rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 @error("branches.{$i}.city") border-red-400 bg-red-50 focus:ring-red-200 @else border-gray-200 focus:ring-black @enderror">
                        @error("branches.{$i}.city")
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            @endforeach
            <div class="flex justify-end">
                <button wire:click="saveBranches"
                        wire:loading.attr="disabled"
                        wire:loading.class="opacity-70 cursor-not-allowed"
                        wire:target="saveBranches"
                        class="bg-black text-white px-6 py-2.5 rounded-xl text-sm font-semibold hover:bg-gray-800 transition inline-flex items-center gap-2">
                    <svg wire:loading wire:target="saveBranches" class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 22 6.477 22 12h-4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span wire:loading.remove wire:target="saveBranches">Save Draft</span>
                    <span wire:loading wire:target="saveBranches">Saving...</span>
                </button>
            </div>
        </div>
    </div>

    {{-- 5. Represented Artists --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="font-semibold text-black">Represented Artists</h2>
            <p class="text-xs text-gray-400 mt-0.5">Artists represented by your gallery</p>
        </div>
        <div class="p-6 space-y-4">
            @foreach($represented_artists as $i => $artist)
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                    Artist Name {{ $i + 1 }} @if($i === 0)<span class="text-red-500">*</span>@endif
                </label>
                <input wire:model="represented_artists.{{ $i }}" type="text" placeholder="Artist full name"
                       class="w-full border rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 @error("represented_artists.{$i}") border-red-400 bg-red-50 focus:ring-red-200 @else border-gray-200 focus:ring-black @enderror">
                @error("represented_artists.{$i}")
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
            @endforeach
            <div class="flex justify-end pt-2">
                <button wire:click="saveRepresentedArtists"
                        wire:loading.attr="disabled"
                        wire:loading.class="opacity-70 cursor-not-allowed"
                        wire:target="saveRepresentedArtists"
                        class="bg-black text-white px-6 py-2.5 rounded-xl text-sm font-semibold hover:bg-gray-800 transition inline-flex items-center gap-2">
                    <svg wire:loading wire:target="saveRepresentedArtists" class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 22 6.477 22 12h-4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span wire:loading.remove wire:target="saveRepresentedArtists">Save Draft</span>
                    <span wire:loading wire:target="saveRepresentedArtists">Saving...</span>
                </button>
            </div>
        </div>
    </div>

    {{-- 6. Booth Selection --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="font-semibold text-black">Booth Selection</h2>
            <p class="text-xs text-gray-400 mt-0.5">Select your preferred booth type</p>
        </div>
        <div class="p-6 space-y-4">
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                    Section <span class="text-red-500">*</span>
                </label>
                <select wire:model="booth_section"
                        class="w-full border rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 @error('booth_section') border-red-400 bg-red-50 focus:ring-red-200 @else border-gray-200 focus:ring-black @enderror">
                    <option value="">Select section</option>
                    <option value="gallery">Gallery</option>
                    <option value="other">Other</option>
                </select>
                @error('booth_section')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">
                    Type of Booth <span class="text-red-500">*</span>
                </label>
                @error('booth_type')
                    <p class="text-xs text-red-500 mb-2">{{ $message }}</p>
                @enderror
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <label class="flex items-start gap-3 p-4 border-2 rounded-xl cursor-pointer transition {{ $booth_type === 'A' ? 'border-black bg-gray-50' : ($errors->has('booth_type') ? 'border-red-300 bg-red-50' : 'border-gray-200 hover:border-gray-300') }}">
                        <input wire:model="booth_type" type="radio" value="A" class="mt-0.5">
                        <div>
                            <p class="font-semibold text-sm text-black">(A) 5 × 5 m</p>
                            <p class="text-xs text-gray-400">25 sqm</p>
                        </div>
                    </label>
                    <label class="flex items-start gap-3 p-4 border-2 rounded-xl cursor-pointer transition {{ $booth_type === 'B' ? 'border-black bg-gray-50' : ($errors->has('booth_type') ? 'border-red-300 bg-red-50' : 'border-gray-200 hover:border-gray-300') }}">
                        <input wire:model="booth_type" type="radio" value="B" class="mt-0.5">
                        <div>
                            <p class="font-semibold text-sm text-black">(B) 4 × 6 m</p>
                            <p class="text-xs text-gray-400">24 sqm</p>
                        </div>
                    </label>
                </div>
            </div>
            <div class="flex justify-end pt-2">
                <button wire:click="saveBooth"
                        wire:loading.attr="disabled"
                        wire:loading.class="opacity-70 cursor-not-allowed"
                        wire:target="saveBooth"
                        class="bg-black text-white px-6 py-2.5 rounded-xl text-sm font-semibold hover:bg-gray-800 transition inline-flex items-center gap-2">
                    <svg wire:loading wire:target="saveBooth" class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 22 6.477 22 12h-4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span wire:loading.remove wire:target="saveBooth">Save Draft</span>
                    <span wire:loading wire:target="saveBooth">Saving...</span>
                </button>
            </div>
        </div>
    </div>

    {{-- 7. Person in Charge --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="font-semibold text-black">Person in Charge</h2>
            <p class="text-xs text-gray-400 mt-0.5">Contact persons for this application</p>
        </div>
        <div class="p-6 space-y-6">
            @foreach($persons_in_charge as $i => $person)
            <div class="{{ $i < 1 ? 'pb-6 border-b border-gray-100' : '' }}">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">
                    {{ $person['position'] }} <span class="text-red-500">*</span>
                </p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                            Name <span class="text-red-500">*</span>
                        </label>
                        <input wire:model="persons_in_charge.{{ $i }}.name" type="text" placeholder="Full name"
                               class="w-full border rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 @error("persons_in_charge.{$i}.name") border-red-400 bg-red-50 focus:ring-red-200 @else border-gray-200 focus:ring-black @enderror">
                        @error("persons_in_charge.{$i}.name")
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                            Contact Number <span class="text-red-500">*</span>
                        </label>
                        <input wire:model="persons_in_charge.{{ $i }}.phone" type="text" placeholder="+66 2 000 0000"
                               class="w-full border rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 @error("persons_in_charge.{$i}.phone") border-red-400 bg-red-50 focus:ring-red-200 @else border-gray-200 focus:ring-black @enderror">
                        @error("persons_in_charge.{$i}.phone")
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-span-2">
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                            Email Address <span class="text-red-500">*</span>
                        </label>
                        <input wire:model="persons_in_charge.{{ $i }}.email" type="email" placeholder="email@gallery.com"
                               class="w-full border rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 @error("persons_in_charge.{$i}.email") border-red-400 bg-red-50 focus:ring-red-200 @else border-gray-200 focus:ring-black @enderror">
                        @error("persons_in_charge.{$i}.email")
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            @endforeach
            <div class="flex justify-end">
                <button wire:click="savePersonsInCharge"
                        wire:loading.attr="disabled"
                        wire:loading.class="opacity-70 cursor-not-allowed"
                        wire:target="savePersonsInCharge"
                        class="bg-black text-white px-6 py-2.5 rounded-xl text-sm font-semibold hover:bg-gray-800 transition inline-flex items-center gap-2">
                    <svg wire:loading wire:target="savePersonsInCharge" class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 22 6.477 22 12h-4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span wire:loading.remove wire:target="savePersonsInCharge">Save Draft</span>
                    <span wire:loading wire:target="savePersonsInCharge">Saving...</span>
                </button>
            </div>
        </div>
    </div>

    {{-- 8. Art Fairs --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="font-semibold text-black">Art Fairs Participated</h2>
            <p class="text-xs text-gray-400 mt-0.5">Art fairs participated in the past 3 years (max 5)</p>
        </div>
        <div class="p-6 space-y-3">
            @foreach($art_fairs as $i => $fair)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="col-span-2">
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                        Art Fair Name {{ $i + 1 }} @if($i === 0)<span class="text-red-500">*</span>@endif
                    </label>
                    <input wire:model="art_fairs.{{ $i }}.name" type="text" placeholder="Fair name"
                           class="w-full border rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 @error("art_fairs.{$i}.name") border-red-400 bg-red-50 focus:ring-red-200 @else border-gray-200 focus:ring-black @enderror">
                    @error("art_fairs.{$i}.name")
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                        Year @if($i === 0)<span class="text-red-500">*</span>@endif
                    </label>
                    <select wire:model="art_fairs.{{ $i }}.year"
                            class="w-full border rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 @error("art_fairs.{$i}.year") border-red-400 bg-red-50 focus:ring-red-200 @else border-gray-200 focus:ring-black @enderror">
                        <option value="">Select year</option>
                        @for($y = date('Y'); $y >= 2000; $y--)
                            <option value="{{ $y }}">{{ $y }}</option>
                        @endfor
                    </select>
                    @error("art_fairs.{$i}.year")
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            @endforeach
            <div class="flex justify-end pt-2">
                <button wire:click="saveArtFairs"
                        wire:loading.attr="disabled"
                        wire:loading.class="opacity-70 cursor-not-allowed"
                        wire:target="saveArtFairs"
                        class="bg-black text-white px-6 py-2.5 rounded-xl text-sm font-semibold hover:bg-gray-800 transition inline-flex items-center gap-2">
                    <svg wire:loading wire:target="saveArtFairs" class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 22 6.477 22 12h-4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span wire:loading.remove wire:target="saveArtFairs">Save Draft</span>
                    <span wire:loading wire:target="saveArtFairs">Saving...</span>
                </button>
            </div>
        </div>
    </div>

    {{-- Submit Button --}}
    <div class="bg-black rounded-2xl p-6 text-center">
        <h3 class="text-white font-semibold mb-2">
            @if($application->status === 'submitted') Application Submitted @else Ready to Submit? @endif
        </h3>
        <p class="text-gray-400 text-sm mb-4">
            @if($application->status === 'submitted')
                Your application has been received. We will contact you shortly.
            @else
                Make sure all sections are complete before submitting
            @endif
        </p>
        @if($application->status !== 'submitted')
        <button wire:click="submitApplication"
                wire:loading.attr="disabled"
                wire:loading.class="opacity-70 cursor-not-allowed"
                wire:target="submitApplication"
                class="bg-white text-black px-8 py-3 rounded-xl text-sm font-semibold hover:bg-gray-100 transition inline-flex items-center gap-2 mx-auto">
            <svg wire:loading wire:target="submitApplication" class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 22 6.477 22 12h-4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span wire:loading.remove wire:target="submitApplication">Submit Application</span>
            <span wire:loading wire:target="submitApplication">Submitting...</span>
        </button>
        @else
        <div class="inline-flex items-center gap-2 bg-white/10 text-white px-6 py-3 rounded-xl text-sm font-semibold">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
            </svg>
            Submitted
        </div>
        @endif
    </div>

</div>
