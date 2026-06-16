<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- ─────────────────── LEFT: Application Data ─────────────────── --}}
    <div class="lg:col-span-2 space-y-5">

        {{-- Gallery Header --}}
        <div class="bg-white border border-gray-100 rounded-2xl p-6">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <h1 class="text-xl font-semibold text-black">
                        {{ $this->application->gallery_name ?: '(Unnamed Gallery)' }}
                    </h1>
                    @if($this->application->gallery_type)
                    <p class="text-sm text-gray-500 mt-1">
                        {{ ucfirst(str_replace('_', ' ', $this->application->gallery_type)) }}
                        @if($this->application->year_founded)
                         · Est. {{ $this->application->year_founded }}
                        @endif
                    </p>
                    @endif
                </div>
                @php
                $statusBadge = match($this->application->status) {
                    'submitted'    => 'bg-blue-50 text-blue-700',
                    'under_review' => 'bg-yellow-50 text-yellow-700',
                    'approved'     => 'bg-green-50 text-green-700',
                    'rejected'     => 'bg-red-50 text-red-700',
                    default        => 'bg-gray-100 text-gray-500',
                };
                @endphp
                <span class="flex-shrink-0 inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $statusBadge }}">
                    {{ ucwords(str_replace('_', ' ', $this->application->status)) }}
                </span>
            </div>
            @if($this->application->description)
            <p class="text-sm text-gray-600 mt-4 leading-relaxed">{{ $this->application->description }}</p>
            @endif
        </div>

        {{-- Applicant --}}
        @if($this->application->user)
        <div class="bg-white border border-gray-100 rounded-2xl p-6">
            <h2 class="text-xs uppercase tracking-widest text-gray-400 mb-4">Applicant</h2>
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-black flex items-center justify-center overflow-hidden flex-shrink-0">
                    @if($this->application->user->profile_photo)
                        <img src="{{ $this->application->user->profile_photo }}" class="w-full h-full object-cover" alt="">
                    @else
                        <span class="text-white text-sm font-semibold">
                            {{ strtoupper(substr($this->application->user->name, 0, 1)) }}
                        </span>
                    @endif
                </div>
                <div>
                    <p class="text-sm font-medium text-black">{{ $this->application->user->name }}</p>
                    <p class="text-xs text-gray-400">{{ $this->application->user->email }}</p>
                </div>
            </div>
        </div>
        @endif

        {{-- Gallery Images --}}
        @if(!empty($this->application->gallery_images))
        <div class="bg-white border border-gray-100 rounded-2xl p-6">
            <h2 class="text-xs uppercase tracking-widest text-gray-400 mb-4">Gallery Images</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                @foreach($this->application->gallery_images as $img)
                <div class="aspect-video bg-gray-50 rounded-xl overflow-hidden">
                    <img src="{{ $img }}" class="w-full h-full object-cover" alt="" loading="lazy">
                </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Contact Information --}}
        <div class="bg-white border border-gray-100 rounded-2xl p-6">
            <h2 class="text-xs uppercase tracking-widest text-gray-400 mb-4">Contact Information</h2>
            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4">
                @foreach([
                    'Website'   => $this->application->website_url,
                    'Email'     => $this->application->gallery_email,
                    'Phone'     => $this->application->phone,
                    'Instagram' => $this->application->instagram,
                    'Facebook'  => $this->application->facebook,
                ] as $label => $value)
                <div>
                    <dt class="text-xs text-gray-400 mb-0.5">{{ $label }}</dt>
                    <dd class="text-sm text-gray-700 break-all">{{ $value ?: '—' }}</dd>
                </div>
                @endforeach
            </dl>
        </div>

        {{-- Business Information --}}
        @if($this->application->business_name || $this->application->business_license || $this->application->head_office_gallery_name)
        <div class="bg-white border border-gray-100 rounded-2xl p-6">
            <h2 class="text-xs uppercase tracking-widest text-gray-400 mb-4">Business Information</h2>
            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4">
                @foreach([
                    'Business Name'       => $this->application->business_name,
                    'Business License'    => $this->application->business_license,
                    'Head Office Gallery' => $this->application->head_office_gallery_name,
                ] as $label => $value)
                <div>
                    <dt class="text-xs text-gray-400 mb-0.5">{{ $label }}</dt>
                    <dd class="text-sm text-gray-700">{{ $value ?: '—' }}</dd>
                </div>
                @endforeach
            </dl>
        </div>
        @endif

        {{-- Office Address --}}
        @if($this->application->office_country || $this->application->office_city)
        <div class="bg-white border border-gray-100 rounded-2xl p-6">
            <h2 class="text-xs uppercase tracking-widest text-gray-400 mb-4">Office Address</h2>
            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4">
                @foreach([
                    'Country' => $this->application->office_country,
                    'City'    => $this->application->office_city,
                    'Zip'     => $this->application->office_zipcode,
                    'Address' => $this->application->office_address,
                ] as $label => $value)
                <div class="{{ $label === 'Address' ? 'sm:col-span-2' : '' }}">
                    <dt class="text-xs text-gray-400 mb-0.5">{{ $label }}</dt>
                    <dd class="text-sm text-gray-700">{{ $value ?: '—' }}</dd>
                </div>
                @endforeach
            </dl>
        </div>
        @endif

        {{-- Director --}}
        @if($this->application->director_name || $this->application->director_email)
        <div class="bg-white border border-gray-100 rounded-2xl p-6">
            <h2 class="text-xs uppercase tracking-widest text-gray-400 mb-4">Gallery Director</h2>
            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4">
                @foreach([
                    'Name'  => $this->application->director_name,
                    'Phone' => $this->application->director_phone,
                    'Email' => $this->application->director_email,
                ] as $label => $value)
                <div>
                    <dt class="text-xs text-gray-400 mb-0.5">{{ $label }}</dt>
                    <dd class="text-sm text-gray-700">{{ $value ?: '—' }}</dd>
                </div>
                @endforeach
            </dl>
        </div>
        @endif

        {{-- Booth Preferences --}}
        @if($this->application->booth_section || $this->application->booth_type)
        <div class="bg-white border border-gray-100 rounded-2xl p-6">
            <h2 class="text-xs uppercase tracking-widest text-gray-400 mb-4">Booth Preferences</h2>
            <div class="space-y-3">
                {{-- Section / Hall / Type --}}
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    @foreach([
                        'Section' => $this->application->booth_section,
                        'Hall'    => $this->application->booth_hall,
                        'Type'    => $this->application->booth_type,
                    ] as $label => $value)
                    @if($value)
                    <div class="border border-gray-200 rounded-xl p-4">
                        <p class="text-xs text-gray-400 mb-1">{{ $label }}</p>
                        <p class="text-sm font-medium text-black">{{ ucfirst(str_replace('_', ' ', $value)) }}</p>
                    </div>
                    @endif
                    @endforeach
                </div>
                {{-- Rates --}}
                @if($this->application->booth_rate_standard || $this->application->booth_rate_special)
                <div class="grid grid-cols-2 gap-3">
                    @foreach([
                        'Standard Rate' => $this->application->booth_rate_standard,
                        'Special Rate'  => $this->application->booth_rate_special,
                    ] as $label => $value)
                    @if($value)
                    <div class="border border-gray-200 rounded-xl p-4">
                        <p class="text-xs text-gray-400 mb-1">{{ $label }}</p>
                        <p class="text-base font-semibold text-black">{{ number_format($value) }}</p>
                    </div>
                    @endif
                    @endforeach
                </div>
                @endif
            </div>
        </div>
        @endif

        {{-- Persons in Charge --}}
        @if(!empty($this->application->persons_in_charge))
        <div class="bg-white border border-gray-100 rounded-2xl p-6">
            <h2 class="text-xs uppercase tracking-widest text-gray-400 mb-4">
                Persons in Charge
                <span class="normal-case text-gray-300 font-normal ml-1">({{ count($this->application->persons_in_charge) }})</span>
            </h2>
            <div class="space-y-3">
                @foreach($this->application->persons_in_charge as $person)
                <div class="bg-gray-50 rounded-xl p-4 grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-2">
                    @foreach((array)$person as $key => $val)
                    @if(!is_null($val) && $val !== '' && !is_array($val))
                    <div>
                        <dt class="text-xs text-gray-400 capitalize mb-0.5">{{ str_replace('_', ' ', $key) }}</dt>
                        <dd class="text-sm text-gray-700">{{ $val }}</dd>
                    </div>
                    @endif
                    @endforeach
                </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Represented Artists --}}
        @if(!empty($this->application->represented_artists))
        <div class="bg-white border border-gray-100 rounded-2xl p-6">
            <h2 class="text-xs uppercase tracking-widest text-gray-400 mb-4">
                Represented Artists
                <span class="normal-case text-gray-300 font-normal ml-1">({{ count($this->application->represented_artists) }})</span>
            </h2>
            <div class="space-y-3">
                @foreach($this->application->represented_artists as $artist)
                @if(is_array($artist))
                <div class="bg-gray-50 rounded-xl p-4 grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-2">
                    @foreach($artist as $key => $val)
                    @if(!is_null($val) && $val !== '' && !is_array($val))
                    <div>
                        <dt class="text-xs text-gray-400 capitalize mb-0.5">{{ str_replace('_', ' ', $key) }}</dt>
                        <dd class="text-sm text-gray-700">{{ $val }}</dd>
                    </div>
                    @endif
                    @endforeach
                </div>
                @else
                <p class="text-sm text-gray-700 py-1">{{ $artist }}</p>
                @endif
                @endforeach
            </div>
        </div>
        @endif

        {{-- Participating Artists --}}
        @if(!empty($this->application->participating_artists))
        <div class="bg-white border border-gray-100 rounded-2xl p-6">
            <h2 class="text-xs uppercase tracking-widest text-gray-400 mb-4">
                Participating Artists (This Fair)
                <span class="normal-case text-gray-300 font-normal ml-1">({{ count($this->application->participating_artists) }})</span>
            </h2>
            <div class="space-y-3">
                @foreach($this->application->participating_artists as $artist)
                @if(is_array($artist))
                <div class="bg-gray-50 rounded-xl p-4 grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-2">
                    @foreach($artist as $key => $val)
                    @if(!is_null($val) && $val !== '' && !is_array($val))
                        @if($key === 'introduction')
                        <div class="sm:col-span-2" x-data="{ open: false }">
                            <dt class="text-xs text-gray-400 capitalize mb-1">Introduction</dt>
                            <dd class="text-sm text-gray-700 leading-relaxed"
                                :class="open ? '' : 'line-clamp-3'">{{ $val }}</dd>
                            @if(strlen($val) > 180)
                            <button @click="open = !open"
                                    class="mt-1.5 text-xs text-gray-400 hover:text-black transition">
                                <span x-text="open ? 'Show less ↑' : 'Show more ↓'"></span>
                            </button>
                            @endif
                        </div>
                        @else
                        <div>
                            <dt class="text-xs text-gray-400 capitalize mb-0.5">{{ str_replace('_', ' ', $key) }}</dt>
                            <dd class="text-sm text-gray-700">{{ $val }}</dd>
                        </div>
                        @endif
                    @endif
                    @endforeach
                </div>
                @else
                <p class="text-sm text-gray-700 py-1">{{ $artist }}</p>
                @endif
                @endforeach
            </div>
        </div>
        @endif

        {{-- Exhibitions --}}
        @if(!empty($this->application->exhibitions))
        <div class="bg-white border border-gray-100 rounded-2xl p-6">
            <h2 class="text-xs uppercase tracking-widest text-gray-400 mb-4">
                Exhibitions
                <span class="normal-case text-gray-300 font-normal ml-1">({{ count($this->application->exhibitions) }})</span>
            </h2>
            <div class="space-y-3">
                @foreach($this->application->exhibitions as $ex)
                @if(is_array($ex))
                <div class="bg-gray-50 rounded-xl p-4 grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-2">
                    @foreach($ex as $key => $val)
                    @if(!is_null($val) && $val !== '' && !is_array($val))
                    <div>
                        <dt class="text-xs text-gray-400 capitalize mb-0.5">{{ str_replace('_', ' ', $key) }}</dt>
                        <dd class="text-sm text-gray-700">{{ $val }}</dd>
                    </div>
                    @endif
                    @endforeach
                </div>
                @else
                <p class="text-sm text-gray-700 py-1">{{ $ex }}</p>
                @endif
                @endforeach
            </div>
        </div>
        @endif

        {{-- Branches --}}
        @if(!empty($this->application->branches))
        <div class="bg-white border border-gray-100 rounded-2xl p-6">
            <h2 class="text-xs uppercase tracking-widest text-gray-400 mb-4">
                Branches
                <span class="normal-case text-gray-300 font-normal ml-1">({{ count($this->application->branches) }})</span>
            </h2>
            <div class="space-y-3">
                @foreach($this->application->branches as $branch)
                @if(is_array($branch))
                <div class="bg-gray-50 rounded-xl p-4 grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-2">
                    @foreach($branch as $key => $val)
                    @if(!is_null($val) && $val !== '' && !is_array($val))
                    <div>
                        <dt class="text-xs text-gray-400 capitalize mb-0.5">{{ str_replace('_', ' ', $key) }}</dt>
                        <dd class="text-sm text-gray-700">{{ $val }}</dd>
                    </div>
                    @endif
                    @endforeach
                </div>
                @else
                <p class="text-sm text-gray-700 py-1">{{ $branch }}</p>
                @endif
                @endforeach
            </div>
        </div>
        @endif

        {{-- Previous Art Fairs --}}
        @if(!empty($this->application->art_fairs))
        <div class="bg-white border border-gray-100 rounded-2xl p-6">
            <h2 class="text-xs uppercase tracking-widest text-gray-400 mb-4">
                Previous Art Fairs
                <span class="normal-case text-gray-300 font-normal ml-1">({{ count($this->application->art_fairs) }})</span>
            </h2>
            <div class="space-y-3">
                @foreach($this->application->art_fairs as $fair)
                @if(is_array($fair))
                <div class="bg-gray-50 rounded-xl p-4 grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-2">
                    @foreach($fair as $key => $val)
                    @if(!is_null($val) && $val !== '' && !is_array($val))
                    <div>
                        <dt class="text-xs text-gray-400 capitalize mb-0.5">{{ str_replace('_', ' ', $key) }}</dt>
                        <dd class="text-sm text-gray-700">{{ $val }}</dd>
                    </div>
                    @endif
                    @endforeach
                </div>
                @else
                <p class="text-sm text-gray-700 py-1">{{ $fair }}</p>
                @endif
                @endforeach
            </div>
        </div>
        @endif

    </div>

    {{-- ─────────────────── RIGHT: Review Sidebar ─────────────────── --}}
    <div>
        <div class="lg:sticky lg:top-24 space-y-4">

            {{-- Meta --}}
            <div class="bg-white border border-gray-100 rounded-2xl p-6 text-xs text-gray-400 space-y-1.5">
                <div class="flex justify-between">
                    <span>Application ID</span>
                    <span class="text-gray-600">#{{ $this->application->id }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Submitted</span>
                    <span class="text-gray-600">{{ $this->application->created_at->format('d M Y') }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Completion</span>
                    <span class="text-gray-600">{{ $this->application->completion_percent ?? 0 }}%</span>
                </div>
            </div>

            {{-- Status & Actions --}}
            <div class="bg-white border border-gray-100 rounded-2xl p-6">
                <h2 class="text-xs uppercase tracking-widest text-gray-400 mb-4">Review Decision</h2>

                {{-- Reviewer stamp --}}
                @if($this->application->reviewed_at)
                <div class="mb-4 pb-4 border-b border-gray-100 text-xs text-gray-400 space-y-0.5">
                    <p>By {{ $this->application->reviewer?->name ?? 'Unknown' }}</p>
                    <p>{{ $this->application->reviewed_at->format('d M Y, H:i') }}</p>
                </div>
                @endif

                {{-- Confirmation dialog --}}
                @if($pendingAction)
                <div class="bg-gray-50 rounded-xl p-4 mb-3">
                    <p class="text-sm text-gray-700 mb-3 font-medium">
                        @if($pendingAction === 'approve') Approve this application?
                        @elseif($pendingAction === 'reject') Reject this application?
                        @else Mark as Under Review?
                        @endif
                    </p>
                    <p class="text-xs text-gray-400 mb-4">This will update the status and record your decision.</p>
                    <div class="flex gap-2">
                        <button wire:click="cancelAction"
                                class="flex-1 text-xs py-2.5 border border-gray-200 rounded-xl hover:border-gray-400 transition">
                            Cancel
                        </button>
                        <button wire:click="executeAction"
                                wire:loading.attr="disabled"
                                class="flex-1 text-xs py-2.5 bg-black text-white rounded-xl hover:bg-gray-800 transition disabled:opacity-60">
                            <span wire:loading.remove wire:target="executeAction">Confirm</span>
                            <span wire:loading wire:target="executeAction">Processing…</span>
                        </button>
                    </div>
                </div>
                @else

                {{-- Action Buttons --}}
                <div class="flex flex-col gap-2">
                    @if($this->application->status === 'draft')
                        <p class="text-xs text-gray-400 text-center py-3">Application not yet submitted.</p>
                    @endif

                    @if($this->application->status === 'submitted')
                    <button wire:click="setAction('review')"
                            class="w-full text-sm py-2.5 border border-gray-200 text-gray-700 rounded-xl hover:border-gray-400 transition">
                        Mark as Under Review
                    </button>
                    @endif

                    @if(in_array($this->application->status, ['submitted', 'under_review', 'rejected']))
                    <button wire:click="setAction('approve')"
                            class="w-full text-sm py-2.5 bg-green-500 text-white rounded-xl hover:bg-green-600 transition">
                        Approve
                    </button>
                    @endif

                    @if(in_array($this->application->status, ['submitted', 'under_review', 'approved']))
                    <button wire:click="setAction('reject')"
                            class="w-full text-sm py-2.5 border border-red-200 text-red-600 rounded-xl hover:bg-red-50 transition">
                        Reject
                    </button>
                    @endif
                </div>
                @endif
            </div>

            {{-- Admin Notes --}}
            <div class="bg-white border border-gray-100 rounded-2xl p-6">
                <h2 class="text-xs uppercase tracking-widest text-gray-400 mb-3">Admin Notes</h2>
                <textarea wire:model="adminNotes"
                          rows="6"
                          placeholder="Internal notes (not visible to applicant)..."
                          class="w-full text-sm border border-gray-200 rounded-xl p-3 focus:outline-none focus:border-black transition resize-none"></textarea>
                <button wire:click="saveNotes"
                        wire:loading.attr="disabled"
                        class="mt-2 w-full text-sm py-2.5 bg-black text-white rounded-xl hover:bg-gray-800 transition disabled:opacity-60">
                    <span wire:loading.remove wire:target="saveNotes">Save Notes</span>
                    <span wire:loading wire:target="saveNotes">Saving…</span>
                </button>
            </div>


        </div>
    </div>

</div>
