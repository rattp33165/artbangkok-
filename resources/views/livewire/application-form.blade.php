<div class="space-y-6">

    {{-- 1. Gallery Information --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-black">Gallery Information</h2>
                <p class="text-xs text-gray-400 mt-0.5">Basic information about your gallery</p>
            </div>
            @if(session('saved_gallery'))
                <span class="text-xs text-green-600 font-medium">✓ Saved</span>
            @endif
        </div>
        <div class="p-6 space-y-4">

            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Gallery Type</label>
                <select wire:model="gallery_type"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-black">
                    <option value="">Select gallery type</option>
                    <option value="international">International Gallery</option>
                    <option value="thai">Thai Gallery</option>
                </select>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Gallery Name (ENG)</label>
                    <input wire:model="gallery_name" type="text" placeholder="Gallery name"
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-black">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Year Founded</label>
                    <input wire:model="year_founded" type="number" placeholder="e.g. 2010"
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-black">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Gallery Brief Description <span class="text-gray-400 normal-case font-normal">(max 1,000 characters)</span></label>
                <textarea wire:model="description" rows="4" placeholder="Describe your gallery..."
                          maxlength="1000"
                          class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-black resize-none"></textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Website URL</label>
                    <input wire:model="website_url" type="url" placeholder="https://yourgallery.com"
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-black">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Gallery Email</label>
                    <input wire:model="gallery_email" type="email" placeholder="gallery@example.com"
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-black">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Phone Number</label>
                    <input wire:model="phone" type="text" placeholder="+66 2 000 0000"
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-black">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Instagram</label>
                    <input wire:model="instagram" type="text" placeholder="@yourgallery"
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-black">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Facebook</label>
                    <input wire:model="facebook" type="text" placeholder="facebook.com/yourgallery"
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-black">
                </div>
            </div>

            <div class="flex justify-end pt-2">
                <button wire:click="saveGalleryInfo"
                        class="bg-black text-white px-6 py-2.5 rounded-xl text-sm font-semibold hover:bg-gray-800 transition">
                    Save Draft
                </button>
            </div>
        </div>
    </div>

    {{-- 2. Business Registration --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-black">Business Registration Information</h2>
                <p class="text-xs text-gray-400 mt-0.5">Official business details</p>
            </div>
            @if(session('saved_business'))
                <span class="text-xs text-green-600 font-medium">✓ Saved</span>
            @endif
        </div>
        <div class="p-6 space-y-4">
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Business or Company Name</label>
                <input wire:model="business_name" type="text" placeholder="Company name"
                       class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-black">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Business License Number</label>
                <input wire:model="business_license" type="text" placeholder="License number"
                       class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-black">
            </div>
            <div class="flex justify-end pt-2">
                <button wire:click="saveBusinessInfo"
                        class="bg-black text-white px-6 py-2.5 rounded-xl text-sm font-semibold hover:bg-gray-800 transition">
                    Save Draft
                </button>
            </div>
        </div>
    </div>

    {{-- 3. Gallery Head Office --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-black">Gallery Head Office Information</h2>
                <p class="text-xs text-gray-400 mt-0.5">Main office location and director details</p>
            </div>
            @if(session('saved_office'))
                <span class="text-xs text-green-600 font-medium">✓ Saved</span>
            @endif
        </div>
        <div class="p-6 space-y-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Country</label>
                    <input wire:model="office_country" type="text" placeholder="Country"
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-black">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">City</label>
                    <input wire:model="office_city" type="text" placeholder="City"
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-black">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Zipcode</label>
                    <input wire:model="office_zipcode" type="text" placeholder="00000"
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-black">
                </div>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Detailed Address</label>
                <textarea wire:model="office_address" rows="2" placeholder="Full address"
                          class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-black resize-none"></textarea>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Director's Name</label>
                    <input wire:model="director_name" type="text" placeholder="Full name"
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-black">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Phone Number</label>
                    <input wire:model="director_phone" type="text" placeholder="+66 2 000 0000"
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-black">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Email Address</label>
                    <input wire:model="director_email" type="email" placeholder="director@gallery.com"
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-black">
                </div>
            </div>
            <div class="flex justify-end pt-2">
                <button wire:click="saveHeadOffice"
                        class="bg-black text-white px-6 py-2.5 rounded-xl text-sm font-semibold hover:bg-gray-800 transition">
                    Save Draft
                </button>
            </div>
        </div>
    </div>

    {{-- 4. Gallery Branches --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-black">Gallery Branch Information</h2>
                <p class="text-xs text-gray-400 mt-0.5">Up to 3 branch locations</p>
            </div>
            @if(session('saved_branches'))
                <span class="text-xs text-green-600 font-medium">✓ Saved</span>
            @endif
        </div>
        <div class="p-6 space-y-6">
            @foreach($branches as $i => $branch)
            <div class="pb-6 {{ $i < 2 ? 'border-b border-gray-100' : '' }}">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Branch {{ $i + 1 }}</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Venue/Branch Name</label>
                        <input wire:model="branches.{{ $i }}.name" type="text" placeholder="Branch name"
                               class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-black">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Country</label>
                        <input wire:model="branches.{{ $i }}.country" type="text" placeholder="Country"
                               class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-black">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">City</label>
                        <input wire:model="branches.{{ $i }}.city" type="text" placeholder="City"
                               class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-black">
                    </div>
                </div>
            </div>
            @endforeach
            <div class="flex justify-end">
                <button wire:click="saveBranches"
                        class="bg-black text-white px-6 py-2.5 rounded-xl text-sm font-semibold hover:bg-gray-800 transition">
                    Save Draft
                </button>
            </div>
        </div>
    </div>

    {{-- 5. Represented Artists --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-black">Represented Artists</h2>
                <p class="text-xs text-gray-400 mt-0.5">Artists represented by your gallery</p>
            </div>
            @if(session('saved_artists'))
                <span class="text-xs text-green-600 font-medium">✓ Saved</span>
            @endif
        </div>
        <div class="p-6 space-y-4">
            @foreach($represented_artists as $i => $artist)
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Artist Name {{ $i + 1 }}</label>
                <input wire:model="represented_artists.{{ $i }}" type="text" placeholder="Artist full name"
                       class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-black">
            </div>
            @endforeach
            <div class="flex justify-end pt-2">
                <button wire:click="saveRepresentedArtists"
                        class="bg-black text-white px-6 py-2.5 rounded-xl text-sm font-semibold hover:bg-gray-800 transition">
                    Save Draft
                </button>
            </div>
        </div>
    </div>

    {{-- 6. Booth Selection --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-black">Booth Selection</h2>
                <p class="text-xs text-gray-400 mt-0.5">Select your preferred booth type</p>
            </div>
            @if(session('saved_booth'))
                <span class="text-xs text-green-600 font-medium">✓ Saved</span>
            @endif
        </div>
        <div class="p-6 space-y-4">
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Section</label>
                <select wire:model="booth_section"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-black">
                    <option value="">Select section</option>
                    <option value="gallery">Gallery</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Type of Booth</label>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <label class="flex items-start gap-3 p-4 border-2 rounded-xl cursor-pointer transition {{ $booth_type === 'A' ? 'border-black bg-gray-50' : 'border-gray-200 hover:border-gray-300' }}">
                        <input wire:model="booth_type" type="radio" value="A" class="mt-0.5">
                        <div>
                            <p class="font-semibold text-sm text-black">(A) 5 × 5 m</p>
                            <p class="text-xs text-gray-400">25 sqm</p>
                        </div>
                    </label>
                    <label class="flex items-start gap-3 p-4 border-2 rounded-xl cursor-pointer transition {{ $booth_type === 'B' ? 'border-black bg-gray-50' : 'border-gray-200 hover:border-gray-300' }}">
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
                        class="bg-black text-white px-6 py-2.5 rounded-xl text-sm font-semibold hover:bg-gray-800 transition">
                    Save Draft
                </button>
            </div>
        </div>
    </div>

    {{-- 7. Person in Charge --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-black">Person in Charge</h2>
                <p class="text-xs text-gray-400 mt-0.5">Contact persons for this application</p>
            </div>
            @if(session('saved_persons'))
                <span class="text-xs text-green-600 font-medium">✓ Saved</span>
            @endif
        </div>
        <div class="p-6 space-y-6">
            @foreach($persons_in_charge as $i => $person)
            <div class="{{ $i < 1 ? 'pb-6 border-b border-gray-100' : '' }}">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">{{ $person['position'] }}</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Name</label>
                        <input wire:model="persons_in_charge.{{ $i }}.name" type="text" placeholder="Full name"
                               class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-black">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Contact Number</label>
                        <input wire:model="persons_in_charge.{{ $i }}.phone" type="text" placeholder="+66 2 000 0000"
                               class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-black">
                    </div>
                    <div class="col-span-2">
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Email Address</label>
                        <input wire:model="persons_in_charge.{{ $i }}.email" type="email" placeholder="email@gallery.com"
                               class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-black">
                    </div>
                </div>
            </div>
            @endforeach
            <div class="flex justify-end">
                <button wire:click="savePersonsInCharge"
                        class="bg-black text-white px-6 py-2.5 rounded-xl text-sm font-semibold hover:bg-gray-800 transition">
                    Save Draft
                </button>
            </div>
        </div>
    </div>

    {{-- 8. Art Fairs --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-black">Art Fairs Participated</h2>
                <p class="text-xs text-gray-400 mt-0.5">Art fairs participated in the past 3 years (max 5)</p>
            </div>
            @if(session('saved_fairs'))
                <span class="text-xs text-green-600 font-medium">✓ Saved</span>
            @endif
        </div>
        <div class="p-6 space-y-3">
            @foreach($art_fairs as $i => $fair)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="col-span-2">
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Art Fair Name {{ $i + 1 }}</label>
                    <input wire:model="art_fairs.{{ $i }}.name" type="text" placeholder="Fair name"
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-black">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Year</label>
                    <input wire:model="art_fairs.{{ $i }}.year" type="number" placeholder="2024"
                           class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-black">
                </div>
            </div>
            @endforeach
            <div class="flex justify-end pt-2">
                <button wire:click="saveArtFairs"
                        class="bg-black text-white px-6 py-2.5 rounded-xl text-sm font-semibold hover:bg-gray-800 transition">
                    Save Draft
                </button>
            </div>
        </div>
    </div>

    {{-- Submit Button --}}
    <div class="bg-black rounded-2xl p-6 text-center">
        <h3 class="text-white font-semibold mb-2">Ready to Submit?</h3>
        <p class="text-gray-400 text-sm mb-4">Make sure all sections are complete before submitting</p>
        <button class="bg-white text-black px-8 py-3 rounded-xl text-sm font-semibold hover:bg-gray-100 transition">
            Submit Application
        </button>
    </div>

</div>
