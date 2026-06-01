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

            {{-- Gallery Images --}}
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                    Gallery Images <span class="text-gray-400 normal-case font-normal">(max 3 images)</span>
                </label>
                @if(count($gallery_images) > 0)
                <div class="flex flex-wrap gap-3 mb-3">
                    @foreach($gallery_images as $idx => $img)
                    <div class="relative group">
                        <img src="{{ Storage::url($img) }}" class="w-24 h-24 object-cover rounded-xl border border-gray-200">
                        <button wire:click="removeGalleryImage({{ $idx }})" type="button"
                                class="absolute -top-2 -right-2 w-5 h-5 bg-red-500 text-white rounded-full text-xs flex items-center justify-center opacity-0 group-hover:opacity-100 transition">✕</button>
                    </div>
                    @endforeach
                </div>
                @endif
                @if(count($gallery_images) < 3)
                <div x-data>
                    <input type="file" wire:model="gallery_images_upload" x-ref="galleryFile" class="hidden" multiple accept="image/jpeg,image/png,image/webp">
                    <button type="button" @click="$refs.galleryFile.click()"
                            class="inline-flex items-center gap-2 border border-dashed border-gray-300 hover:border-gray-500 text-sm text-gray-500 hover:text-black rounded-xl px-4 py-2.5 transition">
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span wire:loading.remove wire:target="gallery_images_upload">Choose Images</span>
                        <span wire:loading wire:target="gallery_images_upload">Uploading...</span>
                    </button>
                </div>
                @endif
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
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                    Gallery Name <span class="text-red-500">*</span>
                </label>
                <input wire:model="head_office_gallery_name" type="text" placeholder="Gallery name at head office"
                       class="w-full border rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 @error('head_office_gallery_name') border-red-400 bg-red-50 focus:ring-red-200 @else border-gray-200 focus:ring-black @enderror">
                @error('head_office_gallery_name')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
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
        <div class="p-6 space-y-4">
            @foreach($branches as $i => $branch)
            <div class="border border-gray-100 rounded-xl p-4">
                <div class="flex items-center justify-between mb-3">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Branch {{ $i + 1 }}</p>
                    @if(count($branches) > 1)
                        <button wire:click="removeBranch({{ $i }})" type="button"
                                class="text-xs text-red-400 hover:text-red-600 transition">Remove</button>
                    @endif
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                            Venue/Branch Name <span class="text-red-500">*</span>
                        </label>
                        <input wire:model="branches.{{ $i }}.name" type="text" placeholder="Branch name"
                               class="w-full border rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 @error("branches.{$i}.name") border-red-400 bg-red-50 focus:ring-red-200 @else border-gray-200 focus:ring-black @enderror">
                        @error("branches.{$i}.name")
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                            Country <span class="text-red-500">*</span>
                        </label>
                        <input wire:model="branches.{{ $i }}.country" type="text" placeholder="Country"
                               class="w-full border rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 @error("branches.{$i}.country") border-red-400 bg-red-50 focus:ring-red-200 @else border-gray-200 focus:ring-black @enderror">
                        @error("branches.{$i}.country")
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                            City <span class="text-red-500">*</span>
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
            <button wire:click="addBranch" type="button"
                    class="inline-flex items-center gap-1.5 text-sm text-gray-500 hover:text-black transition border border-dashed border-gray-300 hover:border-gray-500 rounded-xl px-4 py-2.5 w-full justify-center">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Add Branch
            </button>
            <div class="flex justify-end pt-2">
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
        <div class="p-6 space-y-3">
            @foreach($represented_artists as $i => $artist)
            <div class="flex items-start gap-2">
                <div class="flex-1">
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                        Artist Name {{ $i + 1 }} <span class="text-red-500">*</span>
                    </label>
                    <input wire:model="represented_artists.{{ $i }}" type="text" placeholder="Artist full name"
                           class="w-full border rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 @error("represented_artists.{$i}") border-red-400 bg-red-50 focus:ring-red-200 @else border-gray-200 focus:ring-black @enderror">
                    @error("represented_artists.{$i}")
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                @if(count($represented_artists) > 1)
                    <button wire:click="removeRepresentedArtist({{ $i }})" type="button"
                            class="mt-7 p-2 text-gray-300 hover:text-red-500 transition flex-shrink-0">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                @endif
            </div>
            @endforeach
            <button wire:click="addRepresentedArtist" type="button"
                    class="inline-flex items-center gap-1.5 text-sm text-gray-500 hover:text-black transition border border-dashed border-gray-300 hover:border-gray-500 rounded-xl px-4 py-2.5 w-full justify-center">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Add Artist
            </button>
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
                <div class="flex items-center justify-between mb-3">
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        Type of Booth <span class="text-red-500">*</span>
                    </label>
                    @if($booth_type)
                        <button wire:click="clearBoothType" type="button"
                                class="text-xs text-gray-400 hover:text-red-500 transition">
                            Clear selection
                        </button>
                    @endif
                </div>
                @error('booth_type')
                    <p class="text-xs text-red-500 mb-2">{{ $message }}</p>
                @enderror
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <label class="flex items-start gap-3 p-4 border-2 rounded-xl cursor-pointer transition {{ $booth_type === 'A' ? 'border-black bg-gray-50' : ($errors->has('booth_type') ? 'border-red-300 bg-red-50' : 'border-gray-200 hover:border-gray-300') }}">
                        <input wire:model="booth_type" type="radio" name="booth_type" value="A" class="mt-0.5">
                        <div>
                            <p class="font-semibold text-sm text-black">(A) 5 × 5 m</p>
                            <p class="text-xs text-gray-400">25 sqm</p>
                        </div>
                    </label>
                    <label class="flex items-start gap-3 p-4 border-2 rounded-xl cursor-pointer transition {{ $booth_type === 'B' ? 'border-black bg-gray-50' : ($errors->has('booth_type') ? 'border-red-300 bg-red-50' : 'border-gray-200 hover:border-gray-300') }}">
                        <input wire:model="booth_type" type="radio" name="booth_type" value="B" class="mt-0.5">
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

    {{-- 7. Participating Artists --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="font-semibold text-black">Participating Artist Information</h2>
            <p class="text-xs text-gray-400 mt-0.5">Artists participating in your booth</p>
        </div>
        <div class="p-6 space-y-4">
            @foreach($participating_artists as $i => $artist)
            <div class="border border-gray-100 rounded-xl p-4 space-y-4">
                <div class="flex items-center justify-between">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Artist {{ $i + 1 }}</p>
                    @if(count($participating_artists) > 1)
                        <button wire:click="removeParticipatingArtist({{ $i }})" type="button"
                                class="text-xs text-red-400 hover:text-red-600 transition">Remove</button>
                    @endif
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="sm:col-span-2 lg:col-span-1">
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                            Artist Name <span class="text-red-500">*</span>
                        </label>
                        <input wire:model="participating_artists.{{ $i }}.name" type="text" placeholder="Full name"
                               class="w-full border rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 @error("participating_artists.{$i}.name") border-red-400 bg-red-50 focus:ring-red-200 @else border-gray-200 focus:ring-black @enderror">
                        @error("participating_artists.{$i}.name")
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                            Year of Birth <span class="text-red-500">*</span>
                        </label>
                        <input wire:model="participating_artists.{{ $i }}.year_of_birth" type="number"
                               placeholder="e.g. 1985" min="1900" max="{{ date('Y') }}"
                               class="w-full border rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 @error("participating_artists.{$i}.year_of_birth") border-red-400 bg-red-50 focus:ring-red-200 @else border-gray-200 focus:ring-black @enderror">
                        @error("participating_artists.{$i}.year_of_birth")
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                            Nationality <span class="text-red-500">*</span>
                        </label>
                        <input wire:model="participating_artists.{{ $i }}.nationality" type="text" placeholder="e.g. Thai"
                               class="w-full border rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 @error("participating_artists.{$i}.nationality") border-red-400 bg-red-50 focus:ring-red-200 @else border-gray-200 focus:ring-black @enderror">
                        @error("participating_artists.{$i}.nationality")
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                        Artist's Brief Introduction <span class="text-red-500">*</span>
                        <span class="text-gray-400 normal-case font-normal">(max 1,000 words)</span>
                    </label>
                    <textarea wire:model="participating_artists.{{ $i }}.introduction" rows="3"
                              placeholder="Artist biography and practice..."
                              class="w-full border rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 resize-none @error("participating_artists.{$i}.introduction") border-red-400 bg-red-50 focus:ring-red-200 @else border-gray-200 focus:ring-black @enderror"></textarea>
                    @error("participating_artists.{$i}.introduction")
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                {{-- Artwork Images --}}
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                        Images of Artwork <span class="text-gray-400 normal-case font-normal">(max 3 images)</span>
                    </label>
                    @if(!empty($artist['images']))
                    <div class="flex flex-wrap gap-3 mb-3">
                        @foreach($artist['images'] as $imgIdx => $img)
                        <div class="relative group">
                            <img src="{{ Storage::url($img) }}" class="w-24 h-24 object-cover rounded-xl border border-gray-200">
                            <button wire:click="removeArtistImage({{ $i }}, {{ $imgIdx }})" type="button"
                                    class="absolute -top-2 -right-2 w-5 h-5 bg-red-500 text-white rounded-full text-xs flex items-center justify-center opacity-0 group-hover:opacity-100 transition">✕</button>
                        </div>
                        @endforeach
                    </div>
                    @endif
                    @if(count($artist['images'] ?? []) < 3)
                    <div x-data>
                        <input type="file" wire:model="artist_images_upload"
                               x-ref="artistFile{{ $i }}" class="hidden" multiple accept="image/jpeg,image/png,image/webp">
                        <button type="button"
                                wire:click="prepareArtistUpload({{ $i }})"
                                @click="$nextTick(() => $refs['artistFile{{ $i }}'].click())"
                                class="inline-flex items-center gap-2 border border-dashed border-gray-300 hover:border-gray-500 text-sm text-gray-500 hover:text-black rounded-xl px-4 py-2.5 transition">
                            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            Choose Images
                        </button>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
            <button wire:click="addParticipatingArtist" type="button"
                    class="inline-flex items-center gap-1.5 text-sm text-gray-500 hover:text-black transition border border-dashed border-gray-300 hover:border-gray-500 rounded-xl px-4 py-2.5 w-full justify-center">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Add Artist
            </button>
            <div class="flex justify-end pt-2">
                <button wire:click="saveParticipatingArtists"
                        wire:loading.attr="disabled"
                        wire:loading.class="opacity-70 cursor-not-allowed"
                        wire:target="saveParticipatingArtists"
                        class="bg-black text-white px-6 py-2.5 rounded-xl text-sm font-semibold hover:bg-gray-800 transition inline-flex items-center gap-2">
                    <svg wire:loading wire:target="saveParticipatingArtists" class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 22 6.477 22 12h-4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span wire:loading.remove wire:target="saveParticipatingArtists">Save Draft</span>
                    <span wire:loading wire:target="saveParticipatingArtists">Saving...</span>
                </button>
            </div>
        </div>
    </div>

    {{-- 8. Person in Charge --}}
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

    {{-- 9. Featured Exhibitions --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="font-semibold text-black">Featured Exhibitions at the Gallery</h2>
            <p class="text-xs text-gray-400 mt-0.5">Recent or upcoming exhibitions</p>
        </div>
        <div class="p-6 space-y-4">
            @foreach($exhibitions as $i => $exhibition)
            <div class="border border-gray-100 rounded-xl p-4 space-y-4">
                <div class="flex items-center justify-between">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Exhibition {{ $i + 1 }}</p>
                    @if(count($exhibitions) > 1)
                        <button wire:click="removeExhibition({{ $i }})" type="button"
                                class="text-xs text-red-400 hover:text-red-600 transition">Remove</button>
                    @endif
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                        Exhibition Title <span class="text-red-500">*</span>
                    </label>
                    <input wire:model="exhibitions.{{ $i }}.title" type="text" placeholder="Exhibition title"
                           class="w-full border rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 @error("exhibitions.{$i}.title") border-red-400 bg-red-50 focus:ring-red-200 @else border-gray-200 focus:ring-black @enderror">
                    @error("exhibitions.{$i}.title")
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                            Start Date <span class="text-red-500">*</span>
                        </label>
                        <input wire:model="exhibitions.{{ $i }}.date_start" type="date"
                               class="w-full border rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 @error("exhibitions.{$i}.date_start") border-red-400 bg-red-50 focus:ring-red-200 @else border-gray-200 focus:ring-black @enderror">
                        @error("exhibitions.{$i}.date_start")
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                            End Date <span class="text-red-500">*</span>
                        </label>
                        <input wire:model="exhibitions.{{ $i }}.date_end" type="date"
                               class="w-full border rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 @error("exhibitions.{$i}.date_end") border-red-400 bg-red-50 focus:ring-red-200 @else border-gray-200 focus:ring-black @enderror">
                        @error("exhibitions.{$i}.date_end")
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                        Exhibition / Artist Introduction <span class="text-red-500">*</span>
                        <span class="text-gray-400 normal-case font-normal">(max 1,000 words)</span>
                    </label>
                    <textarea wire:model="exhibitions.{{ $i }}.introduction" rows="3"
                              placeholder="Describe the exhibition and featured artists..."
                              class="w-full border rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 resize-none @error("exhibitions.{$i}.introduction") border-red-400 bg-red-50 focus:ring-red-200 @else border-gray-200 focus:ring-black @enderror"></textarea>
                    @error("exhibitions.{$i}.introduction")
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                {{-- Installation Images --}}
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                        Installation Images <span class="text-gray-400 normal-case font-normal">(max 3 images)</span>
                    </label>
                    @if(!empty($exhibition['images']))
                    <div class="flex flex-wrap gap-3 mb-3">
                        @foreach($exhibition['images'] as $imgIdx => $img)
                        <div class="relative group">
                            <img src="{{ Storage::url($img) }}" class="w-24 h-24 object-cover rounded-xl border border-gray-200">
                            <button wire:click="removeExhibitionImage({{ $i }}, {{ $imgIdx }})" type="button"
                                    class="absolute -top-2 -right-2 w-5 h-5 bg-red-500 text-white rounded-full text-xs flex items-center justify-center opacity-0 group-hover:opacity-100 transition">✕</button>
                        </div>
                        @endforeach
                    </div>
                    @endif
                    @if(count($exhibition['images'] ?? []) < 3)
                    <div x-data>
                        <input type="file" wire:model="exhibition_images_upload"
                               x-ref="exhibitionFile{{ $i }}" class="hidden" multiple accept="image/jpeg,image/png,image/webp">
                        <button type="button"
                                wire:click="prepareExhibitionUpload({{ $i }})"
                                @click="$nextTick(() => $refs['exhibitionFile{{ $i }}'].click())"
                                class="inline-flex items-center gap-2 border border-dashed border-gray-300 hover:border-gray-500 text-sm text-gray-500 hover:text-black rounded-xl px-4 py-2.5 transition">
                            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            Choose Images
                        </button>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
            <button wire:click="addExhibition" type="button"
                    class="inline-flex items-center gap-1.5 text-sm text-gray-500 hover:text-black transition border border-dashed border-gray-300 hover:border-gray-500 rounded-xl px-4 py-2.5 w-full justify-center">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Add Exhibition
            </button>
            <div class="flex justify-end pt-2">
                <button wire:click="saveExhibitions"
                        wire:loading.attr="disabled"
                        wire:loading.class="opacity-70 cursor-not-allowed"
                        wire:target="saveExhibitions"
                        class="bg-black text-white px-6 py-2.5 rounded-xl text-sm font-semibold hover:bg-gray-800 transition inline-flex items-center gap-2">
                    <svg wire:loading wire:target="saveExhibitions" class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 22 6.477 22 12h-4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span wire:loading.remove wire:target="saveExhibitions">Save Draft</span>
                    <span wire:loading wire:target="saveExhibitions">Saving...</span>
                </button>
            </div>
        </div>
    </div>

    {{-- 10. Art Fairs --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="font-semibold text-black">Art Fairs Participated</h2>
            <p class="text-xs text-gray-400 mt-0.5">Art fairs participated in the past 3 years (max 5)</p>
        </div>
        <div class="p-6 space-y-3">
            @foreach($art_fairs as $i => $fair)
            <div class="flex items-start gap-2">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 flex-1">
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                            Art Fair Name {{ $i + 1 }} <span class="text-red-500">*</span>
                        </label>
                        <input wire:model="art_fairs.{{ $i }}.name" type="text" placeholder="Fair name"
                               class="w-full border rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 @error("art_fairs.{$i}.name") border-red-400 bg-red-50 focus:ring-red-200 @else border-gray-200 focus:ring-black @enderror">
                        @error("art_fairs.{$i}.name")
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                            Year <span class="text-red-500">*</span>
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
                @if(count($art_fairs) > 1)
                    <button wire:click="removeArtFair({{ $i }})" type="button"
                            class="mt-7 p-2 text-gray-300 hover:text-red-500 transition flex-shrink-0">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                @endif
            </div>
            @endforeach
            <button wire:click="addArtFair" type="button"
                    class="inline-flex items-center gap-1.5 text-sm text-gray-500 hover:text-black transition border border-dashed border-gray-300 hover:border-gray-500 rounded-xl px-4 py-2.5 w-full justify-center">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Add Art Fair
            </button>
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
