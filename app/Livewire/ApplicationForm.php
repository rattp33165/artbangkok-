<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
    public $booth_type = '';

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
        $this->booth_type               = $app->booth_type ?? '';

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

    public function clearBoothType()
    {
        $this->booth_type = '';
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

    // ── Validation helper ──────────────────────────────────────────

    private function clearIncomplete(string $sectionId): void
    {
        $this->incompleteSections = array_values(array_diff($this->incompleteSections, [$sectionId]));
    }

    private function tryValidate(array $rules, array $messages = []): bool
    {
        try {
            $this->validate($rules, $messages);
            return true;
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->dispatch('toast', message: 'Please fill in all required fields.', type: 'error');
            $this->dispatch('scroll-to-error');
            throw $e;
        }
    }

    // ── Save methods ───────────────────────────────────────────────

    public function saveGalleryInfo()
    {
        $this->tryValidate([
            'gallery_type'  => 'required|in:international,thai',
            'gallery_name'  => 'required|string|max:255',
            'year_founded'  => 'required|integer|min:1800|max:' . date('Y'),
            'description'   => 'required|string|max:1000',
            'website_url'   => 'required|url:http,https',
            'gallery_email' => 'required|email',
            'phone'         => 'required|string|max:50',
            'instagram'     => 'required|string|max:255',
            'facebook'      => 'required|string|max:255',
        ], [
            'website_url.url' => 'The website URL must start with http:// or https:// (e.g., https://yourgallery.com)',
        ]);

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
        $this->tryValidate([
            'business_name'    => 'required|string|max:255',
            'business_license' => 'required|string|max:100',
        ]);

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
        $this->tryValidate([
            'head_office_gallery_name' => 'required|string|max:255',
            'office_country'           => 'required|string|max:100',
            'office_city'              => 'required|string|max:100',
            'office_zipcode'           => 'required|string|max:20',
            'office_address'           => 'required|string|max:500',
            'director_name'            => 'required|string|max:255',
            'director_phone'           => 'required|string|max:50',
            'director_email'           => 'required|email',
        ]);

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
        $this->tryValidate([
            'branches.*.name'    => 'required|string|max:255',
            'branches.*.country' => 'required|string|max:100',
            'branches.*.city'    => 'required|string|max:100',
        ]);

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
        $this->tryValidate([
            'represented_artists.*' => 'required|string|max:255',
        ]);

        $this->application->update([
            'represented_artists' => array_values(array_filter($this->represented_artists)),
        ]);
        $this->updateProgress();
        $this->clearIncomplete('section-artists');
        $this->dispatch('toast', message: 'Represented artists saved.', type: 'success');
    }

    public function saveBooth()
    {
        $this->tryValidate([
            'booth_section' => 'required|in:gallery,other',
            'booth_type'    => 'required|in:A,B',
        ]);

        $this->application->update([
            'booth_section' => $this->booth_section ?: null,
            'booth_type'    => $this->booth_type ?: null,
        ]);
        $this->updateProgress();
        $this->clearIncomplete('section-booth');
        $this->dispatch('toast', message: 'Booth selection saved.', type: 'success');
    }

    public function saveParticipatingArtists()
    {
        $this->tryValidate([
            'participating_artists.*.name'         => 'required|string|max:255',
            'participating_artists.*.year_of_birth' => 'required|integer|min:1900|max:' . date('Y'),
            'participating_artists.*.nationality'   => 'required|string|max:100',
            'participating_artists.*.introduction'  => 'required|string|max:5000',
        ]);

        $this->application->update([
            'participating_artists' => collect($this->participating_artists)->map(fn($a) => [
                'name'         => $a['name'] ?? '',
                'year_of_birth' => $a['year_of_birth'] ?? '',
                'nationality'  => $a['nationality'] ?? '',
                'introduction' => $a['introduction'] ?? '',
                'images'       => $a['images'] ?? [],
            ])->toArray(),
        ]);
        $this->updateProgress();
        $this->clearIncomplete('section-participating');
        $this->dispatch('toast', message: 'Participating artists saved.', type: 'success');
    }

    public function savePersonsInCharge()
    {
        $this->tryValidate([
            'persons_in_charge.0.name'  => 'required|string|max:255',
            'persons_in_charge.0.email' => 'required|email',
            'persons_in_charge.0.phone' => 'required|string|max:50',
            'persons_in_charge.1.name'  => 'required|string|max:255',
            'persons_in_charge.1.email' => 'required|email',
            'persons_in_charge.1.phone' => 'required|string|max:50',
        ]);

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
        $this->tryValidate([
            'exhibitions.*.title'        => 'required|string|max:255',
            'exhibitions.*.date_start'   => 'required|date',
            'exhibitions.*.date_end'     => 'required|date|after_or_equal:exhibitions.*.date_start',
            'exhibitions.*.introduction' => 'required|string|max:5000',
        ]);

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
        $this->tryValidate([
            'art_fairs.*.name' => 'required|string|max:255',
            'art_fairs.*.year' => 'required|integer|min:2000|max:' . date('Y'),
        ]);

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
            (bool)$app->booth_section,
            (bool)(!empty($app->represented_artists) && $app->represented_artists[0]),
            (bool)(!empty($app->participating_artists) && ($app->participating_artists[0]['name'] ?? '')),
            (bool)(!empty($app->persons_in_charge) && ($app->persons_in_charge[0]['name'] ?? '')),
            (bool)(!empty($app->exhibitions) && ($app->exhibitions[0]['title'] ?? '')),
            (bool)(!empty($app->art_fairs) && ($app->art_fairs[0]['name'] ?? '')),
        ];
        $percent = (int)(collect($sections)->filter()->count() / count($sections) * 100);
        $app->update(['completion_percent' => $percent]);
        $this->application = $app;
    }

    public function submitApplication()
    {
        if ($this->application->status === 'submitted') {
            $this->dispatch('toast', message: 'Your application has already been submitted.', type: 'info');
            return;
        }

        $app = $this->application->fresh();
        $incomplete = [];

        if (!$app->gallery_name)                                                                   $incomplete['section-gallery']       = 'Gallery Information';
        if (!$app->business_name)                                                                  $incomplete['section-business']      = 'Business Registration';
        if (!$app->office_country)                                                                 $incomplete['section-office']        = 'Head Office Information';
        if (empty($app->branches) || !($app->branches[0]['name'] ?? ''))                          $incomplete['section-branches']      = 'Gallery Branches';
        if (!$app->booth_section)                                                                  $incomplete['section-booth']         = 'Booth Selection';
        if (empty($app->represented_artists) || !$app->represented_artists[0])                    $incomplete['section-artists']       = 'Represented Artists';
        if (empty($app->participating_artists) || !($app->participating_artists[0]['name'] ?? '')) $incomplete['section-participating'] = 'Participating Artists';
        if (empty($app->persons_in_charge) || !($app->persons_in_charge[0]['name'] ?? ''))        $incomplete['section-persons']       = 'Persons in Charge';
        if (empty($app->exhibitions) || !($app->exhibitions[0]['title'] ?? ''))                   $incomplete['section-exhibitions']   = 'Featured Exhibitions';
        if (empty($app->art_fairs) || !($app->art_fairs[0]['name'] ?? ''))                       $incomplete['section-fairs']         = 'Art Fairs';

        $this->incompleteSections = array_keys($incomplete);

        if (!empty($incomplete)) {
            $names = implode(', ', array_values($incomplete));
            $this->dispatch('toast', message: 'Please save: ' . $names, type: 'error');
            $this->dispatch('scroll-to-section', id: array_key_first($incomplete));
            return;
        }

        $this->incompleteSections = [];
        $this->application->update(['status' => 'submitted']);
        $this->dispatch('toast', message: 'Application submitted successfully!', type: 'success');
    }

    public function render()
    {
        return view('livewire.application-form');
    }
}
