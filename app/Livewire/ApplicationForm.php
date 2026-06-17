<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Application;
use App\Models\BoothHall;
use App\Models\BoothType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ApplicationForm extends Component
{
    use WithFileUploads;

    public $application;

    // Gallery Information
    public $gallery_type = '';
    public $gallery_name = '';
    public $year_founded = '';
    public $description = '';
    public $website_url = '';
    public $gallery_email = '';
    public $phone = '';
    public $instagram = '';
    public $facebook = '';
    public $gallery_images = [];         // stored paths
    public $gallery_images_upload = [];  // temp uploads

    // Business Registration
    public $business_name = '';
    public $business_license = '';

    // Head Office
    public $head_office_gallery_name = '';
    public $office_country = '';
    public $office_city = '';
    public $office_zipcode = '';
    public $office_address = '';
    public $director_name = '';
    public $director_phone = '';
    public $director_email = '';

    // Branches
    public $branches = [
        ['name' => '', 'country' => '', 'city' => ''],
    ];

    // Represented Artists
    public $represented_artists = [''];

    // Booth
    public $booth_section = '';
    public $booth_hall = '';
    public $booth_type = '';
    public $booth_rate_standard = null;
    public $booth_rate_special = null;

    // Participating Artists (dynamic)
    public $participating_artists = [
        ['name' => '', 'year_of_birth' => '', 'nationality' => '', 'introduction' => '', 'images' => []],
    ];
    public $artist_images_upload = [];
    public $active_artist_upload_index = 0;

    public $incompleteSections = [];

    // Person in Charge
    public $persons_in_charge = [
        ['name' => '', 'position' => 'Curator', 'email' => '', 'phone' => ''],
        ['name' => '', 'position' => 'Gallery Manager', 'email' => '', 'phone' => ''],
    ];

    // Exhibitions (dynamic)
    public $exhibitions = [
        ['title' => '', 'date_start' => '', 'date_end' => '', 'introduction' => '', 'images' => []],
    ];
    public $exhibition_images_upload = [];
    public $active_exhibition_upload_index = 0;

    // Art Fairs
    public $art_fairs = [
        ['name' => '', 'year' => ''],
    ];

    public function mount()
    {
        $this->application = Application::firstOrCreate(
            ['user_id' => Auth::id()],
            ['status' => 'draft']
        );
        $this->loadData();
    }

    public function loadData()
    {
        $app = $this->application;
        $this->gallery_type             = $app->gallery_type ?? '';
        $this->gallery_name             = $app->gallery_name ?? '';
        $this->year_founded             = $app->year_founded ?? '';
        $this->description              = $app->description ?? '';
        $this->website_url              = $app->website_url ?? '';
        $this->gallery_email            = $app->gallery_email ?? '';
        $this->phone                    = $app->phone ?? '';
        $this->instagram                = $app->instagram ?? '';
        $this->facebook                 = $app->facebook ?? '';
        $this->gallery_images           = $app->gallery_images ?? [];
        $this->business_name            = $app->business_name ?? '';
        $this->business_license         = $app->business_license ?? '';
        $this->head_office_gallery_name = $app->head_office_gallery_name ?? '';
        $this->office_country           = $app->office_country ?? '';
        $this->office_city              = $app->office_city ?? '';
        $this->office_zipcode           = $app->office_zipcode ?? '';
        $this->office_address           = $app->office_address ?? '';
        $this->director_name            = $app->director_name ?? '';
        $this->director_phone           = $app->director_phone ?? '';
        $this->director_email           = $app->director_email ?? '';
        $this->booth_section            = $app->booth_section ?? '';
        $this->booth_hall               = $app->booth_hall ?? '';
        $this->booth_type               = $app->booth_type ?? '';
        $this->booth_rate_standard      = $app->booth_rate_standard ?? null;
        $this->booth_rate_special       = $app->booth_rate_special ?? null;

        if (!empty($app->branches))             $this->branches = $app->branches;
        if (!empty($app->represented_artists))  $this->represented_artists = $app->represented_artists;
        if (!empty($app->persons_in_charge))    $this->persons_in_charge = $app->persons_in_charge;
        if (!empty($app->art_fairs))            $this->art_fairs = $app->art_fairs;
        if (!empty($app->participating_artists)) $this->participating_artists = $app->participating_artists;
        if (!empty($app->exhibitions))           $this->exhibitions = $app->exhibitions;
    }

    // ── Image uploads ──────────────────────────────────────────────

    public function updatedGalleryImagesUpload()
    {
        $existing = $this->gallery_images ?? [];
        foreach ((array)$this->gallery_images_upload as $file) {
            if (count($existing) >= 3) break;
            $path = $file->store('applications/' . Auth::id() . '/gallery', 'public');
            $existing[] = $path;
        }
        $this->application->update(['gallery_images' => $existing]);
        $this->gallery_images = $existing;
        $this->gallery_images_upload = [];
        $this->dispatch('gallery-uploaded');
        $this->dispatch('toast', message: 'Gallery images uploaded.', type: 'success');
    }

    public function removeGalleryImage($index)
    {
        $images = $this->gallery_images;
        Storage::disk('public')->delete($images[$index]);
        array_splice($images, $index, 1);
        $this->gallery_images = array_values($images);
        $this->application->update(['gallery_images' => $this->gallery_images]);
    }

    public function prepareArtistUpload($index)
    {
        $this->active_artist_upload_index = $index;
    }

    public function updatedArtistImagesUpload()
    {
        $i = $this->active_artist_upload_index;
        $existing = $this->participating_artists[$i]['images'] ?? [];
        foreach ((array)$this->artist_images_upload as $file) {
            if (count($existing) >= 3) break;
            $path = $file->store('applications/' . Auth::id() . '/artists', 'public');
            $existing[] = $path;
        }
        $this->participating_artists[$i]['images'] = $existing;
        $this->artist_images_upload = [];
        $this->dispatch('artist-uploaded');
        $this->dispatch('toast', message: 'Artwork images uploaded.', type: 'success');
    }

    public function removeArtistImage($artistIndex, $imgIndex)
    {
        $images = $this->participating_artists[$artistIndex]['images'] ?? [];
        Storage::disk('public')->delete($images[$imgIndex]);
        array_splice($images, $imgIndex, 1);
        $this->participating_artists[$artistIndex]['images'] = array_values($images);
    }

    public function prepareExhibitionUpload($index)
    {
        $this->active_exhibition_upload_index = $index;
    }

    public function updatedExhibitionImagesUpload()
    {
        $i = $this->active_exhibition_upload_index;
        $existing = $this->exhibitions[$i]['images'] ?? [];
        foreach ((array)$this->exhibition_images_upload as $file) {
            if (count($existing) >= 3) break;
            $path = $file->store('applications/' . Auth::id() . '/exhibitions', 'public');
            $existing[] = $path;
        }
        $this->exhibitions[$i]['images'] = $existing;
        $this->exhibition_images_upload = [];
        $this->dispatch('exhibition-uploaded');
        $this->dispatch('toast', message: 'Exhibition images uploaded.', type: 'success');
    }

    public function removeExhibitionImage($exhibitionIndex, $imgIndex)
    {
        $images = $this->exhibitions[$exhibitionIndex]['images'] ?? [];
        Storage::disk('public')->delete($images[$imgIndex]);
        array_splice($images, $imgIndex, 1);
        $this->exhibitions[$exhibitionIndex]['images'] = array_values($images);
    }

    // ── Dynamic rows ───────────────────────────────────────────────

    public function updatedBoothHall(): void
    {
        $this->booth_type          = '';
        $this->booth_rate_standard = null;
        $this->booth_rate_special  = null;
    }

    public function updatedBoothType($value): void
    {
        $type = BoothType::where('type_code', $value)->first();
        $this->booth_rate_standard = $type?->rate_standard;
        $this->booth_rate_special  = $type?->rate_special;
    }

    public function clearBoothType()
    {
        $this->booth_type = '';
        $this->booth_rate_standard = null;
        $this->booth_rate_special  = null;
    }

    public function addBranch()
    {
        $this->branches[] = ['name' => '', 'country' => '', 'city' => ''];
    }

    public function removeBranch($index)
    {
        if (count($this->branches) > 1) {
            array_splice($this->branches, $index, 1);
            $this->branches = array_values($this->branches);
        }
    }

    public function addRepresentedArtist()
    {
        $this->represented_artists[] = '';
    }

    public function removeRepresentedArtist($index)
    {
        if (count($this->represented_artists) > 1) {
            array_splice($this->represented_artists, $index, 1);
            $this->represented_artists = array_values($this->represented_artists);
        }
    }

    public function addParticipatingArtist()
    {
        $this->participating_artists[] = ['name' => '', 'year_of_birth' => '', 'nationality' => '', 'introduction' => '', 'images' => []];
    }

    public function removeParticipatingArtist($index)
    {
        if (count($this->participating_artists) > 1) {
            array_splice($this->participating_artists, $index, 1);
            $this->participating_artists = array_values($this->participating_artists);
        }
    }

    public function addExhibition()
    {
        $this->exhibitions[] = ['title' => '', 'date_start' => '', 'date_end' => '', 'introduction' => '', 'images' => []];
    }

    public function removeExhibition($index)
    {
        if (count($this->exhibitions) > 1) {
            array_splice($this->exhibitions, $index, 1);
            $this->exhibitions = array_values($this->exhibitions);
        }
    }

    public function addArtFair()
    {
        if (count($this->art_fairs) >= 5) return;
        $this->art_fairs[] = ['name' => '', 'year' => ''];
    }

    public function removeArtFair($index)
    {
        if (count($this->art_fairs) > 1) {
            array_splice($this->art_fairs, $index, 1);
            $this->art_fairs = array_values($this->art_fairs);
        }
    }

    // ── Validation helpers ─────────────────────────────────────────

    private function clearIncomplete(string $sectionId): void
    {
        $this->incompleteSections = array_values(array_diff($this->incompleteSections, [$sectionId]));
    }

    private function allValidationRules(): array
    {
        return [
            'gallery_type'             => 'required|in:international,thai',
            'gallery_name'             => 'required|string|max:255',
            'year_founded'             => 'required|integer|min:1800|max:' . date('Y'),
            'description'              => 'required|string|max:1000',
            'website_url'              => 'required|url|max:500',
            'gallery_email'            => 'required|email',
            'phone'                    => 'required|string|max:50',
            'instagram'                => 'required|string|max:255',
            'facebook'                 => 'required|string|max:255',
            'business_name'            => 'required|string|max:255',
            'business_license'         => 'required|string|max:100',
            'head_office_gallery_name' => 'required|string|max:255',
            'office_country'           => 'required|string|max:100',
            'office_city'              => 'required|string|max:100',
            'office_zipcode'           => 'required|string|max:20',
            'office_address'           => 'required|string|max:500',
            'director_name'            => 'required|string|max:255',
            'director_phone'           => 'required|string|max:50',
            'director_email'           => 'required|email',
            'branches.*.name'          => 'required|string|max:255',
            'branches.*.country'       => 'required|string|max:100',
            'branches.*.city'          => 'required|string|max:100',
            'represented_artists.*'    => 'required|string|max:255',
            'booth_section'            => 'required|in:gallery,other',
            'booth_hall'               => 'required|exists:booth_halls,code',
            'booth_type'               => 'required|exists:booth_types,type_code',
            'participating_artists.*.name'          => 'required|string|max:255',
            'participating_artists.*.year_of_birth' => 'required|integer|min:1900|max:' . date('Y'),
            'participating_artists.*.nationality'   => 'required|string|max:100',
            'participating_artists.*.introduction'  => 'required|string|max:5000',
            'persons_in_charge.0.name'  => 'required|string|max:255',
            'persons_in_charge.0.email' => 'required|email',
            'persons_in_charge.0.phone' => 'required|string|max:50',
            'persons_in_charge.1.name'  => 'required|string|max:255',
            'persons_in_charge.1.email' => 'required|email',
            'persons_in_charge.1.phone' => 'required|string|max:50',
            'exhibitions.*.title'       => 'required|string|max:255',
            'exhibitions.*.date_start'  => 'required|date',
            'exhibitions.*.date_end'    => 'required|date|after_or_equal:exhibitions.*.date_start',
            'exhibitions.*.introduction' => 'required|string|max:5000',
            'art_fairs.*.name'          => 'required|string|max:255',
            'art_fairs.*.year'          => 'required|integer|min:2000|max:' . date('Y'),
        ];
    }

    private function allValidationAttributes(): array
    {
        return [
            'gallery_type'             => 'Gallery Type',
            'gallery_name'             => 'Gallery Name',
            'year_founded'             => 'Year Founded',
            'description'              => 'Description',
            'website_url'              => 'Website URL',
            'gallery_email'            => 'Gallery Email',
            'phone'                    => 'Phone',
            'instagram'                => 'Instagram',
            'facebook'                 => 'Facebook',
            'business_name'            => 'Business Name',
            'business_license'         => 'Business License',
            'head_office_gallery_name' => 'Head Office Gallery Name',
            'office_country'           => 'Country',
            'office_city'              => 'City',
            'office_zipcode'           => 'Zip Code',
            'office_address'           => 'Address',
            'director_name'            => 'Director Name',
            'director_phone'           => 'Director Phone',
            'director_email'           => 'Director Email',
            'booth_section'            => 'Booth Section',
            'booth_hall'               => 'Hall',
            'booth_type'               => 'Booth Type',
            'branches.*.name'          => 'Branch Name',
            'branches.*.country'       => 'Branch Country',
            'branches.*.city'          => 'Branch City',
            'represented_artists.*'    => 'Artist Name',
            'participating_artists.*.name'          => 'Artist Name',
            'participating_artists.*.year_of_birth' => 'Year of Birth',
            'participating_artists.*.nationality'   => 'Nationality',
            'participating_artists.*.introduction'  => 'Artist Introduction',
            'persons_in_charge.0.name'  => 'Curator Name',
            'persons_in_charge.0.email' => 'Curator Email',
            'persons_in_charge.0.phone' => 'Curator Phone',
            'persons_in_charge.1.name'  => 'Gallery Manager Name',
            'persons_in_charge.1.email' => 'Gallery Manager Email',
            'persons_in_charge.1.phone' => 'Gallery Manager Phone',
            'exhibitions.*.title'        => 'Exhibition Title',
            'exhibitions.*.date_start'   => 'Start Date',
            'exhibitions.*.date_end'     => 'End Date',
            'exhibitions.*.introduction' => 'Exhibition Introduction',
            'art_fairs.*.name'           => 'Art Fair Name',
            'art_fairs.*.year'           => 'Art Fair Year',
        ];
    }

    private function sectionsFromErrors(array $errorKeys): array
    {
        $map = [
            'section-gallery'       => ['gallery_type', 'gallery_name', 'year_founded', 'description', 'website_url', 'gallery_email', 'phone', 'instagram', 'facebook'],
            'section-business'      => ['business_name', 'business_license'],
            'section-office'        => ['head_office_gallery_name', 'office_country', 'office_city', 'office_zipcode', 'office_address', 'director_name', 'director_phone', 'director_email'],
            'section-branches'      => ['branches'],
            'section-artists'       => ['represented_artists'],
            'section-booth'         => ['booth_section', 'booth_hall', 'booth_type'],
            'section-participating' => ['participating_artists'],
            'section-persons'       => ['persons_in_charge'],
            'section-exhibitions'   => ['exhibitions'],
            'section-fairs'         => ['art_fairs'],
        ];

        $sections = [];
        foreach ($map as $sectionId => $prefixes) {
            foreach ($errorKeys as $key) {
                foreach ($prefixes as $prefix) {
                    if (str_starts_with($key, $prefix)) {
                        $sections[] = $sectionId;
                        break 2;
                    }
                }
            }
        }
        return array_unique(array_values($sections));
    }

    private function allApplicationData(): array
    {
        return [
            'gallery_type'             => $this->gallery_type ?: null,
            'gallery_name'             => $this->gallery_name ?: null,
            'year_founded'             => $this->year_founded ?: null,
            'description'              => $this->description ?: null,
            'website_url'              => $this->website_url ?: null,
            'gallery_email'            => $this->gallery_email ?: null,
            'phone'                    => $this->phone ?: null,
            'instagram'                => $this->instagram ?: null,
            'facebook'                 => $this->facebook ?: null,
            'business_name'            => $this->business_name ?: null,
            'business_license'         => $this->business_license ?: null,
            'head_office_gallery_name' => $this->head_office_gallery_name ?: null,
            'office_country'           => $this->office_country ?: null,
            'office_city'              => $this->office_city ?: null,
            'office_zipcode'           => $this->office_zipcode ?: null,
            'office_address'           => $this->office_address ?: null,
            'director_name'            => $this->director_name ?: null,
            'director_phone'           => $this->director_phone ?: null,
            'director_email'           => $this->director_email ?: null,
            'booth_section'            => $this->booth_section ?: null,
            'booth_hall'               => $this->booth_hall ?: null,
            'booth_type'               => $this->booth_type ?: null,
            'booth_rate_standard'      => $this->booth_rate_standard ?: null,
            'booth_rate_special'       => $this->booth_rate_special ?: null,
            'branches'                 => collect($this->branches)->map(fn($b) => [
                'name'    => $b['name'] ?? '',
                'country' => $b['country'] ?? '',
                'city'    => $b['city'] ?? '',
            ])->toArray(),
            'represented_artists'      => array_values(array_filter($this->represented_artists)),
            'participating_artists'    => collect($this->participating_artists)->map(fn($a) => [
                'name'          => $a['name'] ?? '',
                'year_of_birth' => $a['year_of_birth'] ?? '',
                'nationality'   => $a['nationality'] ?? '',
                'introduction'  => $a['introduction'] ?? '',
                'images'        => $a['images'] ?? [],
            ])->toArray(),
            'persons_in_charge'        => collect($this->persons_in_charge)->map(fn($p) => [
                'name'     => $p['name'] ?? '',
                'position' => $p['position'] ?? '',
                'email'    => $p['email'] ?? '',
                'phone'    => $p['phone'] ?? '',
            ])->toArray(),
            'exhibitions'              => collect($this->exhibitions)->map(fn($e) => [
                'title'        => $e['title'] ?? '',
                'date_start'   => $e['date_start'] ?? '',
                'date_end'     => $e['date_end'] ?? '',
                'introduction' => $e['introduction'] ?? '',
                'images'       => $e['images'] ?? [],
            ])->toArray(),
            'art_fairs'                => collect($this->art_fairs)->map(fn($f) => [
                'name' => $f['name'] ?? '',
                'year' => $f['year'] ?? '',
            ])->values()->toArray(),
        ];
    }

    // ── Save methods (no validation — draft only) ──────────────────

    public function requestEdit(): void
    {
        if ($this->application->status !== 'approved') return;
        if ($this->application->edit_requested) return;

        $this->application->update(['edit_requested' => true]);
        $this->dispatch('toast', message: 'Edit request submitted. Awaiting admin approval.', type: 'info');
    }

    private function isLocked(): bool
    {
        return in_array($this->application->status, ['submitted', 'under_review', 'approved']);
    }

    public function saveGalleryInfo()
    {
        if ($this->isLocked()) return;
        $this->resetErrorBag();
        $this->application->update([
            'gallery_type'  => $this->gallery_type ?: null,
            'gallery_name'  => $this->gallery_name ?: null,
            'year_founded'  => $this->year_founded ?: null,
            'description'   => $this->description ?: null,
            'website_url'   => $this->website_url ?: null,
            'gallery_email' => $this->gallery_email ?: null,
            'phone'         => $this->phone ?: null,
            'instagram'     => $this->instagram ?: null,
            'facebook'      => $this->facebook ?: null,
        ]);
        $this->updateProgress();
        $this->clearIncomplete('section-gallery');
        $this->dispatch('toast', message: 'Gallery information saved.', type: 'success');
    }

    public function saveBusinessInfo()
    {
        if ($this->isLocked()) return;
        $this->resetErrorBag();
        $this->application->update([
            'business_name'    => $this->business_name ?: null,
            'business_license' => $this->business_license ?: null,
        ]);
        $this->updateProgress();
        $this->clearIncomplete('section-business');
        $this->dispatch('toast', message: 'Business information saved.', type: 'success');
    }

    public function saveHeadOffice()
    {
        if ($this->isLocked()) return;
        $this->resetErrorBag();
        $this->application->update([
            'head_office_gallery_name' => $this->head_office_gallery_name ?: null,
            'office_country'           => $this->office_country ?: null,
            'office_city'              => $this->office_city ?: null,
            'office_zipcode'           => $this->office_zipcode ?: null,
            'office_address'           => $this->office_address ?: null,
            'director_name'            => $this->director_name ?: null,
            'director_phone'           => $this->director_phone ?: null,
            'director_email'           => $this->director_email ?: null,
        ]);
        $this->updateProgress();
        $this->clearIncomplete('section-office');
        $this->dispatch('toast', message: 'Head office information saved.', type: 'success');
    }

    public function saveBranches()
    {
        if ($this->isLocked()) return;
        $this->resetErrorBag();
        $this->application->update([
            'branches' => collect($this->branches)->map(fn($b) => [
                'name'    => $b['name'] ?? '',
                'country' => $b['country'] ?? '',
                'city'    => $b['city'] ?? '',
            ])->toArray(),
        ]);
        $this->updateProgress();
        $this->clearIncomplete('section-branches');
        $this->dispatch('toast', message: 'Branches saved.', type: 'success');
    }

    public function saveRepresentedArtists()
    {
        if ($this->isLocked()) return;
        $this->resetErrorBag();
        $this->application->update([
            'represented_artists' => array_values(array_filter($this->represented_artists)),
        ]);
        $this->updateProgress();
        $this->clearIncomplete('section-artists');
        $this->dispatch('toast', message: 'Represented artists saved.', type: 'success');
    }

    public function saveBooth()
    {
        if ($this->isLocked()) return;
        $this->resetErrorBag();
        $this->application->update([
            'booth_section'       => $this->booth_section ?: null,
            'booth_hall'          => $this->booth_hall ?: null,
            'booth_type'          => $this->booth_type ?: null,
            'booth_rate_standard' => $this->booth_rate_standard ?: null,
            'booth_rate_special'  => $this->booth_rate_special ?: null,
        ]);
        $this->updateProgress();
        $this->clearIncomplete('section-booth');
        $this->dispatch('toast', message: 'Booth selection saved.', type: 'success');
    }

    public function saveParticipatingArtists()
    {
        if ($this->isLocked()) return;
        $this->resetErrorBag();
        $this->application->update([
            'participating_artists' => collect($this->participating_artists)->map(fn($a) => [
                'name'          => $a['name'] ?? '',
                'year_of_birth' => $a['year_of_birth'] ?? '',
                'nationality'   => $a['nationality'] ?? '',
                'introduction'  => $a['introduction'] ?? '',
                'images'        => $a['images'] ?? [],
            ])->toArray(),
        ]);
        $this->updateProgress();
        $this->clearIncomplete('section-participating');
        $this->dispatch('toast', message: 'Participating artists saved.', type: 'success');
    }

    public function savePersonsInCharge()
    {
        if ($this->isLocked()) return;
        $this->resetErrorBag();
        $this->application->update([
            'persons_in_charge' => collect($this->persons_in_charge)->map(fn($p) => [
                'name'     => $p['name'] ?? '',
                'position' => $p['position'] ?? '',
                'email'    => $p['email'] ?? '',
                'phone'    => $p['phone'] ?? '',
            ])->toArray(),
        ]);
        $this->updateProgress();
        $this->clearIncomplete('section-persons');
        $this->dispatch('toast', message: 'Persons in charge saved.', type: 'success');
    }

    public function saveExhibitions()
    {
        if ($this->isLocked()) return;
        $this->resetErrorBag();
        $this->application->update([
            'exhibitions' => collect($this->exhibitions)->map(fn($e) => [
                'title'        => $e['title'] ?? '',
                'date_start'   => $e['date_start'] ?? '',
                'date_end'     => $e['date_end'] ?? '',
                'introduction' => $e['introduction'] ?? '',
                'images'       => $e['images'] ?? [],
            ])->toArray(),
        ]);
        $this->updateProgress();
        $this->clearIncomplete('section-exhibitions');
        $this->dispatch('toast', message: 'Exhibitions saved.', type: 'success');
    }

    public function saveArtFairs()
    {
        if ($this->isLocked()) return;
        $this->resetErrorBag();
        $this->application->update([
            'art_fairs' => collect($this->art_fairs)->map(fn($f) => [
                'name' => $f['name'] ?? '',
                'year' => $f['year'] ?? '',
            ])->values()->toArray(),
        ]);
        $this->updateProgress();
        $this->clearIncomplete('section-fairs');
        $this->dispatch('toast', message: 'Art fairs saved.', type: 'success');
    }

    public function updateProgress()
    {
        $app = $this->application->fresh();
        $sections = [
            (bool)$app->gallery_name,
            (bool)$app->business_name,
            (bool)$app->office_country,
            (bool)(!empty($app->branches) && ($app->branches[0]['name'] ?? '')),
            (bool)($app->booth_section && $app->booth_hall && $app->booth_type),
            (bool)(!empty($app->represented_artists) && $app->represented_artists[0]),
            (bool)(!empty($app->participating_artists) && ($app->participating_artists[0]['name'] ?? '')),
            (bool)(!empty($app->persons_in_charge) && ($app->persons_in_charge[0]['name'] ?? '')),
            (bool)(!empty($app->exhibitions) && ($app->exhibitions[0]['title'] ?? '')),
            (bool)(!empty($app->art_fairs) && ($app->art_fairs[0]['name'] ?? '')),
        ];
        $percent = (int)(collect($sections)->filter()->count() / count($sections) * 100);
        $app->update(['completion_percent' => $percent]);
        $this->application = $app;
        $this->dispatch('progress-updated', percent: $percent);
    }

    public function submitApplication()
    {
        if ($this->isLocked()) return;

        if ($this->application->status === 'submitted') {
            $this->dispatch('toast', message: 'Your application has already been submitted.', type: 'info');
            return;
        }

        $validator = Validator::make($this->allApplicationData(), $this->allValidationRules(), [], $this->allValidationAttributes());

        if ($validator->fails()) {
            $this->setErrorBag($validator->errors());
            $this->incompleteSections = $this->sectionsFromErrors(array_keys($validator->errors()->toArray()));

            $sectionLabels = [
                'section-gallery'       => 'Gallery Information',
                'section-business'      => 'Business Registration',
                'section-office'        => 'Head Office',
                'section-branches'      => 'Branches',
                'section-artists'       => 'Represented Artists',
                'section-booth'         => 'Booth Selection',
                'section-participating' => 'Participating Artists',
                'section-persons'       => 'Persons in Charge',
                'section-exhibitions'   => 'Exhibitions',
                'section-fairs'         => 'Art Fairs',
            ];
            $names = array_map(fn($s) => $sectionLabels[$s] ?? $s, $this->incompleteSections);
            $message = 'Please fix errors in: ' . implode(', ', $names);

            $this->dispatch('toast', message: $message, type: 'error');
            $this->dispatch('scroll-to-error', sectionId: $this->incompleteSections[0] ?? null);
            return;
        }

        $this->application->update($this->allApplicationData() + ['status' => 'submitted']);
        $this->incompleteSections = [];
        $this->updateProgress();
        session()->flash('toast', ['message' => 'Application submitted successfully!', 'type' => 'success']);
        $this->redirect(route('dashboard'), navigate: false);
    }

    public function render()
    {
        return view('livewire.application-form', [
            'boothHalls'   => BoothHall::with(['activeTypes'])
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->get(),
            'isLocked'     => $this->isLocked(),
            'editRequested' => (bool) $this->application->edit_requested,
        ]);
    }
}
